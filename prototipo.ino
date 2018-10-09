//http://ei-ess-g3-webapp.orgfree.com/ftp/
//username:ei-ess-g3-webapp.orgfree.com  password:1q2w3e4r5t
#include <Process.h>
#include <Bridge.h>



#define TRIG_PIN 8
#define ECHO_PIN 9
#define BUZZER 3
#define LDR A3
#define LED 6

long motionDetector = 0;
String airTemperature;
String dateTime;
float temperature = 0;
int luminosityValue = 0;
String stateOfDay;

void setup() {
  Bridge.begin();
  Serial.begin(9600);
  pinMode(BUZZER, OUTPUT);
  pinMode(LED, OUTPUT);
  

  Serial.println("Programa iniciado.");
}

void loop() {

  motionDetector = getDistance();
  if( motionDetector < 115 ){
    Serial.println("Moviemnto Detetado");
    dateTime = getDateTime();
    postMotionDetectedToWebservice(dateTime);
    delay(3000);
  }
  
  airTemperature = getTemperature();
  dateTime = getDateTime();
  temperature = airTemperature.toFloat();
  if(temperature >= 33.0){
    beep(200);
  }
  postFireDetectedToWebservice(airTemperature, dateTime);
  delay(3000);

  
  luminosityValue = analogRead(LDR);
  Serial.println(luminosityValue);
  Serial.print("lm");
  if(luminosityValue < 800)
  { 
    stateOfDay = "day";
    digitalWrite(LED,LOW);
    postLuminosityToWebservice(stateOfDay);
    delay(5000);
  }else if (luminosityValue >= 800)
  {
    stateOfDay = "nigth";
    digitalWrite(LED,HIGH);
    postLuminosityToWebservice(stateOfDay);
    delay(5000);
  }
  
  delay(2000);
      
}

void beep(unsigned char delayms){
  analogWrite(BUZZER, 100);      
                           
  delay(delayms);          
  analogWrite(BUZZER, 0);       
  delay(delayms);           
}  

long microsecondsToCentimeters(long microseconds)
{
  return microseconds / 29 / 2;
}

long getDistance (){
  long duration, distance;
 
  pinMode(TRIG_PIN, OUTPUT);
  digitalWrite(TRIG_PIN,LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG_PIN, LOW);
  
  pinMode(ECHO_PIN, INPUT);
  duration = pulseIn(ECHO_PIN, HIGH);


  distance = microsecondsToCentimeters(duration);

  Serial.print(distance);
  Serial.print(" cm");
  Serial.println();
  
  delay(100);

  return distance;
}

String getTemperature()
{
  Serial.print("A obter temperatura... ");
  int sensor = analogRead(A4);
  float temp = ((float)sensor * 5.0 / 1024.0) * 100.0;
  String tempStr = String(temp, 1);
  Serial.print(tempStr);
  Serial.println("C");
  return tempStr;
}


String getDateTime()
{
  String now = "?";
  Serial.print("A obter hora... ");
  
  Process p;
  p.begin("date");
  p.addParameter("+'%d-%m-%Y %H:%M:%S\'");
  p.run();
  // obter resultado do comando (data formatada)
  if (p.available() > 0)
  now = p.readStringUntil('\n');
  Serial.println(now);
  return now;
}

void postMotionDetectedToWebservice(String dateTime)
{

  String urlWebservice = "http://ei-ess-g3-webapp.orgfree.com/motionDetector.php";
  
  String autenticacao = "grupo3";
  Serial.print("A enviar dados...");
  
  Process p;
  p.begin("curl");
  p.addParameter("--data"); 
  String curlData = "autenticacao=" + autenticacao; 
  curlData += "&key=motion&date=" + dateTime; 
  p.addParameter(curlData);
  p.addParameter(urlWebservice);
  p.run();

  while (p.available() > 0)
  {
    char c = p.read();
    Serial.print(c);
  }
  Serial.println("acabou");
}


void postFireDetectedToWebservice(String temp, String dateTime)
{

  String urlWebservice = "http://ei-ess-g3-webapp.orgfree.com/fireDetector.php";
  
  String autenticacao = "grupo3";
  Serial.print("A enviar dados...");
  
  Process p;
  p.begin("curl");
  p.addParameter("--data"); 
  String curlData = "autenticacao=" + autenticacao; 
  curlData += "&key=ta&value=" + temp + "&date=" + dateTime; 
  p.addParameter(curlData);
  p.addParameter(urlWebservice);
  p.run();

  while (p.available() > 0)
  {
    char c = p.read();
    Serial.print(c);
  }
  Serial.println("acabou");
}


void postLuminosityToWebservice(String luminosity)
{

  String urlWebservice = "http://ei-ess-g3-webapp.orgfree.com/luminosityDetector.php";
  
  String autenticacao = "grupo3";
  Serial.print("A enviar dados...");
  
  Process p;
  p.begin("curl");
  p.addParameter("--data"); 
  String curlData = "autenticacao=" + autenticacao; 
  curlData += "&key=lum&value=" + luminosity; 
  p.addParameter(curlData);
  p.addParameter(urlWebservice);
  p.run();

  while (p.available() > 0)
  {
    char c = p.read();
    Serial.print(c);
  }
  Serial.println("acabou");
}
