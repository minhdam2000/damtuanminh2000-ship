#!/usr/bin/env python
# coding: utf8


import os
import argparse
import time
import mysql.connector
import pandas as pd
import json

from PyPDF2 import PdfFileMerger

# convert("input.docx")
# convert("input.docx", "output.pdf")
# convert("my_docx_folder/")
link = "/var/www/html/ship/storage/app/"
with open('/var/www/html/ship/storage/app/mysql.json', 'r') as myfile:
	data = myfile.read()
	mysqlconf = json.loads(data)

mydb = mysql.connector.connect(
		host=mysqlconf["host"],
		user=mysqlconf["user"],
		password=mysqlconf["password"],
		database=mysqlconf["database"]
	)
mycursor = mydb.cursor()


sql1 =  "SELECT id,name from projects"

from fpdf import FPDF



mycursor.execute(sql1)


list_project = mycursor.fetchall()


folder_name = "nhatki"

files =[file for file in os.listdir(link + "nhatki")]
for file in files:
		if ".pdf" in file:
			continue
	# try:
		print("doc2pdf "+link+"nhatki/"+file + " -o "+"nhatkipdf/"+file.split(".")[0]+".pdf")
		os.system("doc2pdf "+link+"nhatki/"+file)
	# except:
	# 	print(file)
	# 	continue



for project in list_project:
	pdfs = []
	files =[file for file in os.listdir(folder_name)]
	print(files)
	for file in files:
		if ".pdf" not in file:
			continue
		if str(project[0]) + "-" in file:
			print(file)
			pdfs.append(folder_name+"/"+file)


	merger = PdfFileMerger()

	for pdf in pdfs:
		try:
			merger.append(pdf)
		except:
			continue

	merger.write(link+"quyennk/"+str(project[0])+".pdf")
	merger.close()




quit()




