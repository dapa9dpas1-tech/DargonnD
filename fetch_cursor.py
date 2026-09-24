import urllib.request
import re

url = "https://custom-cursor.com/en/collection/bloons-td/btd6-monkey-hand"
req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0 Safari/537.36'})
try:
    with urllib.request.urlopen(req) as response:
        html = response.read().decode('utf-8')
        # Custom cursor images are usually .png and inside <img ... src="..."> or meta tags
        images = re.findall(r'https://cdn.custom-cursor.com/[a-zA-Z0-9_/-]+\.png', html)
        print("FOUND:", list(set(images)))
except Exception as e:
    print("Error:", e)
