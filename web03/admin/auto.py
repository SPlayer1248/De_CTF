# -*- coding: utf-8 -*-
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time
usr = "admin"
pwd = "admin"

driver = webdriver.Firefox()
# cookie = {"key": "value"}
# driver.add_cookie(cookie)


# all_cookies = driver.get_cookies()
# for cookie_name, cookie_value in all_cookies.items():
#     print "%s -> %s", cookie_name, cookie_value

driver.get("http://xss.test.com:8082/login.php")
element = WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.ID, "body")))
elem = driver.find_element_by_name("username")
elem.send_keys(usr)
elem = driver.find_element_by_name("password")
elem.send_keys(pwd)
elem.send_keys(Keys.RETURN)

while 1:
	id = 1
	while 1:
		try:
			driver.get("http://xss.test.com:8082/detail.php?mess_id=" + str(id))
			
			time.sleep(5)
			if "Server not found" in driver.page_source:
				break
			if "404 Not Found" in driver.page_source :
				break
			else:
				print driver.page_source
				id = id + 1
		except:
			id = id + 1
	time.sleep(2)