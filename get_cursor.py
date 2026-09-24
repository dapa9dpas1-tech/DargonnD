import requests, re
url = 'https://custom-cursor.com/en/collection/bloons-td/btd6-monkey-hand'
headers = {'User-Agent': 'Mozilla/5.0'}
r = requests.get(url, headers=headers)
print("status:", r.status_code)
imgs = re.findall(r'https://cdn\.custom-cursor\.com/[^\s\"\']+\.png', r.text)
print("imgs:", list(set(imgs)))
