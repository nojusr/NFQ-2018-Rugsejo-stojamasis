#!/usr/bin/python
from robobrowser import RoboBrowser
import random
import re

addamount = 100

url = 'http://192.168.1.130:2015'

name = ['Lukas', 'Ignas', 'Arnas', 'Mantas', 'Saulius', 'Marijonas', 'Vytautas', 'Jevgeij', 'Julius', 'Justas', 'Naglis', 'Ttas', 'Nerijus', 'Laurynas', 'Paulius', 'Jonas', 'Matas', 'Erikas', 'Edvinas', 'Benas', 'Arnis', 'Martynas', 'Augustinas', 'Emilis', 'Airidas']
surname = ['Abadauskas', 'Abakas', 'Ablunskis', 'Acavicius', 'Achanbachas', 'Babickas', 'Babusis', 'Buzvietis', 'Buzeris', 'Butrimavicius', 'Ravas', 'Rabcevicius', 'Ruze', 'Ruzauskas', 'Iglevicius', 'Ignataitis', 'Saulius', 'Macaitis', 'Musonas', 'Musnickas']
city = ['Kaunas', 'Vilnius', 'Palanga', 'Klaipėda', 'Šiauliai', 'Domeikava', 'Babtai', 'Kedainiai', 'Utena']

color=['Juoda', 'Balta']
ram=['16 GB', '32 GB', '64 GB', '128 GB']
ssd=['128 GB', '256 GB', '512 GB', '1 TB', '2 TB']
hdd=['1 TB', '2 TB', '4 TB', '8 TB']
gpu=['GTX 1080', 'GTX 1080Ti', 'TITAN Xp', 'RTX 2080', 'RTX 2080Ti', 'AMD RX 580X', 'AMD RX 570X']
cpu=['Ryzen 7 2700X', 'Threadripper 2950X', 'Intel Core i5-7600K', 'Intel Core i7-7820X', 'Intel Core i9-7980XE']

browser = RoboBrowser(history=False)
browser.open(url)
for i in range(addamount):
	form = browser.get_form(0)
	
	rname = random.choice(name)
	form['name'].value = rname
	form['surname'].value = random.choice(surname)
	form['addr'].value = random.choice(city)
	form['email'].value = ''.join((rname.lower(), str(random.randint(1, 9999)), "@gmail.com"))
	form['color'].value = random.choice(color)
	form['ram'].value = random.choice(ram)
	form['ssd'].value = random.choice(ssd)
	form['hdd'].value = random.choice(hdd)
	form['gpu'].value = random.choice(gpu)
	form['cpu'].value = random.choice(cpu)
	browser.submit_form(form)


