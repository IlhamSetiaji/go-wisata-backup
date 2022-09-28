#!C:\Python37\python
import os
import sys
import time
from datetime import datetime
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support.ui import Select
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.options import Options
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import InvalidSelectorException
from selenium.common.exceptions import TimeoutException
from selenium.common.exceptions import StaleElementReferenceException
from selenium.common.exceptions import ElementClickInterceptedException
from selenium.common.exceptions import ElementNotInteractableException
from selenium.common.exceptions import InvalidSessionIdException
from selenium.common.exceptions import NoAlertPresentException

import mysql.connector
from mysql.connector import Error

import urllib.request
import urllib3


def connect(host='https://ibank.bni.co.id'):
	try:
		urllib.request.urlopen(host) #Python 3.x
		return True
	except:
		return False

#try:
#    from PIL import Image
#except ImportError:
#    import Image
import pytesseract
from PIL import Image

import cv2

def convertdate(strdate):
	datesplit=strdate.split('-')
	if datesplit[1]=='Jan':
		month=1
	elif datesplit[1]=='Feb':
		month=2
	elif datesplit[1]=='Mar':
		month=3
	elif datesplit[1]=='Apr':
		month=4
	elif datesplit[1]=='May':
		month=5
	elif datesplit[1]=='Jun':
		month=6
	elif datesplit[1]=='Jul':
		month=7
	elif datesplit[1]=='Aug':
		month=8
	elif datesplit[1]=='Sep':
		month=9
	elif datesplit[1]=='Oct':
		month=10
	elif datesplit[1]=='Nov':
		month=11
	elif datesplit[1]=='Dec':
		month=12
	tgl=datesplit[2]+"-"+str(month)+"-"+datesplit[0]
	return tgl
#	format_str = '%d/%m/%Y'
#	datetime_obj = datetime.datetime.strptime(date_str, format_str)
#	print(datetime_obj.date())
#	exit()


def inputMutasi(connection,cursor,tanggal,bank,noRek,ket,statInOut,nominal,tglInsert):
	if statInOut=='Cr.':
		try:
			SQLquery = """INSERT INTO mutasi_bank (bank,noRek,tanggal,ket,debet,kredit,tanggal_insert) VALUES (%s,%s,%s,%s,%s,%s,%s) """
			recTuple = (bank,noRek,tanggal,ket,0,nominal,tglInsert)
			result = cursor.execute(SQLquery,recTuple)
			connection.commit()
		except mysql.connector.IntegrityError as err:
			pass
	elif statInOut=='Db.':
		try:
	#	print(bank,noRek,tanggal,ket,nominal,0,tglInsert)
			SQLquery = """INSERT INTO mutasi_bank (bank,noRek,tanggal,ket,debet,kredit,tanggal_insert) VALUES (%s,%s,%s,%s,%s,%s,%s) """
			recTuple = (bank,noRek,tanggal,ket,nominal,0,tglInsert)
			result = cursor.execute(SQLquery,recTuple)
			connection.commit()
		except mysql.connector.IntegrityError as err:
			pass


def cekExistMutasi(connection,cursor,tgl,bank,noRek,nominal,ket,statInOut):
#	cursor.connection.cursor()
	if statInOut=='Cr.':
		SQLquery = """SELECT * FROM mutasi_bank WHERE tanggal='"""+tgl+"""' and bank='"""+bank+"""' and norek='"""+noRek+"""' and kredit="""+str(nominal)+""" and ket='"""+ket+"""' limit 1"""
	elif statInOut=='Db.':
		#print(tgl,bank,noRek,nominal,)
		SQLquery = """SELECT * FROM mutasi_bank WHERE tanggal='"""+tgl+"""' and bank='"""+bank+"""' and norek='"""+noRek+"""' and debet="""+str(nominal)+""" and ket='"""+ket+"""' limit 1"""
	cursor.execute(SQLquery)
	records=cursor.fetchall()
	count=cursor.rowcount
	if count>0:
		return True
	else:
		return False


def ocr_core(filename):
#	tesseract_cmd: 'C:\\Program Files (x86)\\Tesseract-OCR\\tesseract'
	tesseract_cmd: 'C:\\Program Files (x86)\\Tesseract-OCR\\tessdata'
#	pytesseract.pytesseract.tesseract_cmd ='C:\\Program Files (x86)\\Tesseract-OCR\\tesseract'
	text = pytesseract.image_to_string(Image.open(filename))
	return text

def outputmutasi(datamutasi):
	result=[]
#	datamutasi='26-Jun-2022 TRF/PAY/TOP-UP ECHANNEL Sdri SEPTRI ODE PUTRI  Cr. 138,835.00 154,338,094.00'
	detailMutasi=datamutasi.split()
	countTrx=len(detailMutasi)
	idxTotal=countTrx-1
	idxNominal=countTrx-2
	idxStatus=countTrx-3
	tgl=detailMutasi[0]
	#result.append(tgl)
	nominal=detailMutasi[idxNominal]
	#result.append(nominal)
	status=detailMutasi[idxStatus]
	#result.append(status)
	ket=""

	for x in range(idxTotal):
		if x!=0:
			if x!=idxTotal:
				if x!=idxNominal:
					if x!=idxStatus:
						ket=ket+" "+detailMutasi[x]
		#ket=ket+detailMutasi[x]
		result=[tgl,nominal,status,ket]
	return result

#chrome_options = webdriver.ChromeOptions()  
#chrome_options.add_argument("--headless")
#pathDriver = "C:UsersgraysonDownloadschromedriver.exe"
#options = webdriver.ChromeOptions()
#options.add_argument('headless') # engage headless mode
#options.add_argument('window-size=1200x600') # setting window size is optional
#driver = webdriver.Chrome('c:\chromeDriver\chromedriver.exe',10,chrome_options=options)
#driver = webdriver.Chrome(executable_path=pathDriver, chrome_options=options)
#print("JOSSS")
#exit()
z=0
while True:
#	curr_datetime = datetime.now()
#	curr_hour = curr_datetime.hour
#	curr_time=curr_datetime.time
#	print(curr_time)
	#currentDT = datetime.now()
	#curr_time=currentDT.strftime("%H:%M:%S")
	#if curr_time>23:30:36
	#print(curr_time)
	#exit()
	textCaptcha=""
	k=0
#	z=0
	while textCaptcha=="":
		try:
		#	if connect():

			driver = webdriver.Chrome('c:\chromeDriver\chromedriver.exe',100)
			driver.get("https://ibank.bni.co.id/corp/AuthenticationController?__START_TRAN_FLAG__=Y&FORMSGROUP_ID__=AuthenticationFG&__EVENT_ID__=LOAD&FG_BUTTONS__=LOAD/ACTION.LOAD=Y&AuthenticationFG.LOGIN_FLAG=1&BANK_ID=BNI01&LANGUAGE_ID=002")
			time.sleep(3)
			i=0
		#	username = driver.find_element_by_id("AuthenticationFG.USER_PRINCIPAL")
			username = driver.find_element(By.ID, "AuthenticationFG.USER_PRINCIPAL")
			time.sleep(1)
		#	password = driver.find_element_by_id("AuthenticationFG.ACCESS_CODE")
			password = driver.find_element(By.ID, "AuthenticationFG.ACCESS_CODE")
			#driver.find_element_by_tag_name("button")

		#	imgCaptcha=driver.find_element_by_id("IMAGECAPTCHA")
			imgCaptcha = driver.find_element(By.ID, "IMAGECAPTCHA")
			location = imgCaptcha.location
			size = imgCaptcha.size
			driver.save_screenshot('bni.png')
		#	username.send_keys("PULSA2016")
			username.send_keys("PULSA2016")
		#	password.send_keys("smile2018")
			password.send_keys("smile2022")

		#images = driver.find_elements_by_tag_name('img')
		#for image in imgCaptcha:
		#print(imgCaptcha.get_attribute('src'))
		#IMG=driver.get(imgCaptcha.get_attribute('src'))
		#time.sleep(3)
		#urllib.request.urlretrieve(imgCaptcha.get_attribute('src'), "Captcha.jpg")
		#print(IMG)
			image = cv2.imread("bni.png")
		#	cropped = image[290:315, 100:155]
  

			# cropped = image[440:475, 150:240]
			cropped = image[10:450, 100:250]
		#cv2.imshow("cropped", cropped)
			cv2.imwrite("chaptchabni.png", cropped)
		#	gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
		#	thresh = 255 - cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY_INV + cv2.THRESH_OTSU)[1]
			# Blur and perform text extraction
		#	thresh = cv2.GaussianBlur(thresh, (3,3), 0)
		#	data = pytesseract.image_to_string(thresh, lang='eng', config='--psm 6')
		#	print(data)
		#	exit()
		#cv2.waitKey(0)
		#img_cv = cv2.imread(r'bni.png')
		#img_rgb = cv2.cvtColor(img_cv, cv2.COLOR_BGR2RGB)
		#print(pytesseract.image_to_string(img_rgb))
		#pytesseract.pytesseract.tesseract_cmd = r'C:\Prog.split('\n')ram Files\Tesseract-OCR\tesseract'
		#	pytesseract.pytesseract.tesseract_cmd=r'C:\\Program Files (x86)\Tesseract-OCR\tesseract.exe'
		#	pytesseract.pytesseract.tesseract_cmd=r'C:\Program Files (x86)\Tesseract-OCR\tesseract.exe'
		#	pytesseract.pytesseract.tesseract_cmd=r'C:\Program Files (x86)\Tesseract-OCR\tessdata'
		#pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract'
		#pytesseract.image_to_string(Image.open('chaptchabni.png'))
		#resText=pytesseract.image_to_string(Image.open('chaptchabni.png')).split('\n')
		#	exit()
		#	img = Image.open('D:\\proyek\\python\\bank\\chaptchabni.png')
		#	print(img)
		#	exit()
			textCaptcha=pytesseract.image_to_string('chaptchabni.png')
		#countText=len(resText)
		#print(countText)
		#print(resText)
		#	print(textCaptcha)
		#	exit()
		#for i in range(countText):
			#print(i,resText[i])
		#	if i==30:
		#		textCaptcha=resText[i]
			textCaptcha1=textCaptcha.replace("s","5")
			textCaptcha2=textCaptcha1.replace("S","5")
			textCaptcha3=textCaptcha2.replace("f","7")
			textCaptcha4=textCaptcha3.replace("F","7")
			textCaptcha5=textCaptcha4.replace("e","2")
			textCaptcha6=textCaptcha5.replace("r","2")
			textCaptcha7=textCaptcha6.replace(" ","")
			textCaptcha=textCaptcha6.strip()
		#	print(textCaptcha)
		#	exit()
			tipeResult=textCaptcha.isdigit()
			print(textCaptcha,tipeResult)
		#	exit()
			if not textCaptcha.isdigit():
				if k==2:
					time.sleep(50)
					k=0
				k=k+1
				time.sleep(5)
				print("test-1")
			#	exit()
				driver.close()
				textCaptcha=""
			elif textCaptcha=="":
				if k==2:
					time.sleep(50)
					k=0
				k=k+1
				time.sleep(5)
				print("Test-2")
			#	exit()
				driver.close()
			else:
				print("Ok-1")
			#	exit()
			#	Auth = driver.find_element_by_id("AuthenticationFG.VERIFICATION_CODE")
				Auth = driver.find_element(By.ID,"AuthenticationFG.VERIFICATION_CODE")
				Auth.send_keys(textCaptcha)
				time.sleep(3)
				print("-Login-")
				#exit()
				loginSubmit=WebDriverWait(driver,50).until(EC.element_to_be_clickable((By.ID, "VALIDATE_CREDENTIALS")))
				driver.execute_script("arguments[0].click();",loginSubmit)
			time.sleep(2)
		#	print("Hallo...")
		#	exit()
			try:
				error=WebDriverWait(driver, 3).until(EC.visibility_of_element_located((By.XPATH, "//*[@class='error_highlight']")))
			#	WebDriverWait(driver, 20).until(EC.visibility_of_element_located((By.XPATH, "//*[@class='error_highlight']")))
			#	time.sleep(50)
				textCaptcha==""
			except InvalidSessionIdException:
				time.sleep(90)
				textCaptcha==""
			except NoSuchElementException:
				time.sleep(2)
			except TimeoutException:
				time.sleep(2)

			#	textCaptcha==""

		#else:
		#	time.sleep(15)
		#	textCaptcha==""
		except urllib3.exceptions.MaxRetryError:
			time.sleep(50)
			textCaptcha==""
		except urllib3.exceptions.NewConnectionError:
			time.sleep(50)
			textCaptcha==""
		except urllib3.exceptions.ConnectTimeoutError:
			time.sleep(50)
			textCaptcha==""
	#	except urllib3.exceptions.ConnectionRefusedError
	#exit;
	#	if textCaptcha.isdigit():
	if connect():
	#	z=z+1
	#	if z==4:
	#		for jedaX in range(90):
			#time.sleep(120)
	#			strX=str(jedaX)+"|"
	#			sys.stdout.write(strX)
	#			sys.stdout.flush()
	#			time.sleep(1)
	#		z=0
#		Auth = driver.find_element_by_id("AuthenticationFG.VERIFICATION_CODE")
#		Auth.send_keys(textCaptcha)
#		time.sleep(3)
#		print("-Login-")

		#input()
		#exit()
		#loginSubmit= driver.find_element_by_id("VALIDATE_CREDENTIALS")
	#	if ():
	#		loginSubmit=WebDriverWait(driver,50).until(EC.element_to_be_clickable((By.ID, "VALIDATE_CREDENTIALS")))
				#time.sleep(1)
				#driver.execute_script("encryptValues(this.id)",loginSubmit)
	#		driver.execute_script("arguments[0].click();",loginSubmit)
		#	for i in range(6):
		#	if connect():
			#	time.sleep(3)
		try:
			z=z+1
			print("Cek Mutasi :",z)
			WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID, "REKENING"))).click() 
				#driver.find_element_by_id("REKENING").click()
			#	time.sleep(3)
			#	driver.find_element_by_id("Informasi-Saldo--Mutasi_Mutasi-Tabungan--Giro").click()

			WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID, "Informasi-Saldo--Mutasi_Mutasi-Tabungan--Giro"))).click()
			time.sleep(5)
		#driver.find_element_by_id("VIEW_TRANSACTION_HISTORY").click()
	
			#	driver.find_element_by_id("VIEW_MINI_STATEMENT").click()
						
			WebDriverWait(driver, 50).until(EC.presence_of_element_located((By.ID, "VIEW_MINI_STATEMENT")))
			WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID, "VIEW_MINI_STATEMENT"))).click()
			time.sleep(4)
			print('Ok-2')
		except TimeoutException:
			try:
				objAlert = driver.switch_to.alert
				time.sleep(1)
				objAlert.accept()
			except NoAlertPresentException:
				pass
			WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"HREF_Logout"))).click()
			WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"LOG_OUT"))).click()
			WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"Caption256476"))).click()
			driver.quit()
		except ElementClickInterceptedException:
			try:
				objAlert = driver.switch_to.alert
				time.sleep(1)
				objAlert.accept()
			except NoAlertPresentException:
				pass
			try:
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"HREF_Logout"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"LOG_OUT"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"Caption256476"))).click()
			#	driver.close()
				driver.quit()
			except:
				pass
		except NoSuchElementException:
			try:
				objAlert = driver.switch_to.alert
				time.sleep(1)
				objAlert.accept()
			except NoAlertPresentException:
				pass
			try:
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"HREF_Logout"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"LOG_OUT"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"Caption256476"))).click()
			#	driver.close()
				driver.quit()
			except:
				pass
		else:
			#tag_list = driver.find_elements_by_xpath("//div[@class='listwhiterow']")
			#tag_list = driver.find_element_by_id("0")
			print('Ok-3')
			try:
			#	all_spans = driver.find_elements_by_xpath("//span[@class='searchsimpletext']")
			#	all_spans = driver.find_element(By.XPATH,"//tbody/span[@class='searchsimpletext']")
				all_spans = driver.find_element(By.XPATH,"//table[@id='transactionsList']/tbody")
			#	all_spans = driver.find_element(By.ID,"HREF_txnDateOutput")
			#	/span[@class='searchsimpletext']")
			#	"//button[@class='btn authorize unlocked']/span[text()='Authenticate']"
			#	all_spans = driver.find_element(By.CLASS_NAME, "searchsimpletext")
				print('Ok-4')
				res=all_spans.text
				allText=res.splitlines(True)
				countMutasi=len(allText)
				allListMutasi=[]
				allListKet=[]
				allListInOut=[]
				allListTgl=[]
				allListNominal=[]
				print(countMutasi)
				for x in range(11):
					i=0
					if x!=0:
						resMutasi=outputmutasi(allText[x])
					#	print(resMutasi)
						dates=convertdate(resMutasi[0])
					#	print(dates)
						allListTgl.append(dates)
						allListKet.append(resMutasi[3])
						allListInOut.append(resMutasi[2])
						allListNominal.append(resMutasi[1])
			#	print(allListTgl)
			#	print('TOOOP')
			#	time.sleep(20)
			#	print(outputmutasi(allText))
				#print(allText[1],countMutasi)
			#	print(res)
			#	time.sleep(10)
			#	print('Wait 10 menit')
			#	time.sleep(10)
				i=0
				j=0
				
				
				
				
			#	for span in all_spans:
					#print('Ok-span')
			#		print(span.text)
				#	print(span[0])
				#	x = txt.splitlines()
					#time.sleep(10)
			#		allListMutasi.append(span.text)
			#		print(allListMutasi)
			#		print("YESSSS")
			#		time.sleep(20)
			#		if i>9:
			#			k=(i+1)%5
			#data=span.split('\n')
			#			allListMutasi.append(span.text)
			#			print(allListMutasi)
					#sizeData=len(data)
			#			if k>0:
			#	#print(i,"----------------------------------------------------")
			#				if k==1:
			#					if allListMutasi[j]!="":
			#						dates=convertdate(allListMutasi[j])
			#						allListTgl.append(dates)
			#				if k==2:
			#					if allListMutasi[j]!="":
			#						allListKet.append(allListMutasi[j])
			#				if k==3:
			#					if allListMutasi[j]!="":
			#						allListInOut.append(allListMutasi[j])
			#				if k==4:
			#					if allListMutasi[j]!="":
			#						allListNominal.append(allListMutasi[j])
			#			j=j+1
			#		i=i+1

				countList=len(allListTgl)
				currentDT = datetime.now()
				currentDT.strftime('%Y-%m-%d %H:%M:%S')
			#	print("")
			#	print("Count :",countList,"Terakhir Update :",currentDT)
				print("----------------------------------------------------------------")
				#sleep(50)
				print('OK-5')
				time.sleep(20)
				if countList>0:
					try:
						connection = mysql.connector.connect(host='localhost',database='lungo',user='root',password='',charset='utf8',use_unicode=True)	
				#		connection = mysql.connector.connect(host='192.168.1.10',database='refill',user='admin',password='',charset='utf8',use_unicode=True)
				#		cursor = connection.cursor()
					except Error as e:
						print("Error while connecting to MySQL", e)
					finally:
						print('OK-6')
						if (connection.is_connected()):
							print('OK-7')
							cursor = connection.cursor()
							bank="BNI"
							noRek="0427816559"
							for i in range(countList):
								nominalX=allListNominal[i].replace(',','')
								nominalY=nominalX.split(".")
								nominal=round(float(nominalY[0]))
								currentDT = datetime.now()
								currentDT.strftime('%Y-%m-%d %H:%M:%S')
								tgl=allListTgl[i]
								ket=allListKet[i]
								statInOut=allListInOut[i]
								statEksis=cekExistMutasi(connection,cursor,tgl,bank,noRek,nominal,ket,statInOut)
								if statEksis==False:	
									inputMutasi(connection,cursor,tgl,bank,noRek,ket,statInOut,nominal,currentDT)
									print("Input",tgl,bank,noRek,nominal,ket,statInOut)
								print(statEksis,allListTgl[i],allListKet[i],allListInOut[i],nominal,statInOut)
					#	time.sleep(1)
							cursor.close()
							connection.close()
							print("----------------------------------------------------------------")
							print("BNI Update -- :",noRek,currentDT)
				#	print("----------------------------------------------------------------")
				#		time.sleep(2)
				try:
					objAlert = driver.switch_to.alert
					time.sleep(1)
					objAlert.accept()
				except NoAlertPresentException:
					pass
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"PREVENT_SESSION_TIMEOUT__"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"HREF_Logout"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"LOG_OUT"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"Caption256476"))).click()
				driver.quit()
				print("----------------------------------------------------------------")
			#	driver.close()
			
				
				
				#	objAlert = driver.switch_to.alert
			#	time.sleep(1)
			#	objAlert.accept()
			#	WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"HREF_Logout"))).click()
		#	driver.find_element_by_id("HREF_Logout").click()
		#	time.sleep(2)
			#	WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"LOG_OUT"))).click()
		#	driver.find_element_by_id("LOG_OUT").click()
		#	time.sleep(2)
		#		WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"Caption256476"))).click()
		#	driver.find_element_by_id("Caption256476").click()
		#			print("----------------------------------------------------------------")
				#driver.close()
		#			driver.quit()
				#					try:
				#						WebDriverWait(driver, 1).until(EC.alert_is_present())
				#						alert = driver.switch_to.alert
				#						alert.accept()
				#					except:
				#						pass
				#		print("Waiting Next Process ....")
				#		print("Terakhir Update :",currentDT)
						#	for jeda0 in range(33):
						#		jeda0=jeda0+1
						#		strS="*"
						#		sys.stdout.write(strS)
						#		sys.stdout.flush()
						#		time.sleep(1)
						#		if connect():
						#			try:
						#				WebDriverWait(driver,1).until(EC.alert_is_present())
						#				alert = driver.switch_to.alert
						#				alert.accept()
						#				pass
						#			except:
						#				pass
							#	pass
						#		else:
						#			jeda0=jeda0-1
				for jeda in range(300):
					jeda=jeda+1
			#print(str(jeda),end='')
		#	strX=str(jeda)+"*"
					strX=str(jeda)+"*"
					sys.stdout.write(strX)
					sys.stdout.flush()
					time.sleep(1)
					if jeda==199:
						if connect():
							pass
						else:
							jeda=jeda-1
			except:
				try:
					objAlert = driver.switch_to.alert
					time.sleep(1)
					objAlert.accept()
				except NoAlertPresentException:
					pass
				
				#print("----------------------------------------------------------------")
				time.sleep(50)
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"PREVENT_SESSION_TIMEOUT__"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"HREF_Logout"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"LOG_OUT"))).click()
				WebDriverWait(driver,100).until(EC.element_to_be_clickable((By.ID,"Caption256476"))).click()
				driver.quit()
		
		#except 
			#	driver.find_element_by_id("PREVENT_SESSION_TIMEOUT__").click()
			
			
				#	if jeda==30:
				#		jeda=0
	#		else:
	#			time.sleep(1)
	#			pass
	else:
		print("Keluaran Captcha",textCaptcha)
		pass
		#	exit()
#else:
#	pass
#	print(allListKet[i])
#	print(allListInOut[i])
#	print(allListNominal[i])

#driver.find_element_by_id("HREF_actNoOutput[0]").click()

#driver.find_element_by_id("SEARCH").click()
#time.sleep(6)
#driver.find_element_by_id("VIEW_TRANSACTION_HISTORY").click()

#loginSubmit.submit()
#loginSubmit.click()
#driver.execute_script('return encryptValues(this.id);")', loginSubmit)
#loginSubmit.submit()
#que=driver.find_elements_by_xpath("//input[@name='AuthenticationFG.USER_PRINCIPAL']")
#que.send_keys("Pulsa2011")
#print(driver)
