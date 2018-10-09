import requests
import picamera
from time import sleep

while True:
    file_name = "capture.jpg"
    url="http://ei-ess-g3-webapp.orgfree.com/files/motion_detected.txt" 
    r=requests.get(url)
    print(r.text)
    sleep(2)
    if r.text == "motion":
        camera = picamera.PiCamera()
        camera.hflip = True
        camera.vflip = True
        print("a capturar imagem...")
        camera.capture(file_name)
        camera.close()
        sleep(1)
        print("ok")
        print("a enviar para o servico Web...")
        url = "http://ei-ess-g3-webapp.orgfree.com/feedCamera.php" 
        _file = {'file': open("capture.jpg", 'rb')}
        _data = {'autenticacao': 'grupo3'} 
        r = requests.post(url, data=_data, files=_file)
        sleep(10)
        print("mudar motion_detected.txt..")
        url = "http://ei-ess-g3-webapp.orgfree.com/noMotion.php" 
        _data = {'autenticacao': 'grupo3', 'key': 'no motion'} 
        r = requests.post(url, data=_data)
                
        
        
