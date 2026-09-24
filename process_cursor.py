from PIL import Image
import os

img_path = r"C:\Users\MyBook Hype AMD\.gemini\antigravity-ide\brain\62ce10e5-b5ab-41f3-a190-f7ba25312081\.user_uploaded\media_1788849374950.png"
img = Image.open(img_path).convert("RGBA")

width, height = img.size
half_w = width // 2

# Crop left and right
img_normal = img.crop((0, 0, half_w, height))
img_pointer = img.crop((half_w, 0, width, height))

# Resize to 32x32
size = (32, 32)
img_normal = img_normal.resize(size, Image.Resampling.LANCZOS)
img_pointer = img_pointer.resize(size, Image.Resampling.LANCZOS)

# Save
out_dir = r"c:\xampp\htdocs\king\assets"
os.makedirs(out_dir, exist_ok=True)

img_normal.save(os.path.join(out_dir, "cursor_normal.png"))
img_pointer.save(os.path.join(out_dir, "cursor_pointer.png"))

print("Cursors saved successfully!")
