import hashlib
import random
import string

def id_generator(size=6, chars=string.ascii_uppercase + string.digits):
   return ''.join(random.choice(chars) for _ in range(size))

methods = []
text = id_generator(60, "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz")
methods.append(hashlib.sha1(text.encode('utf-8')).hexdigest())
methods.append(hashlib.sha224(text.encode('utf-8')).hexdigest())
methods.append(hashlib.sha256(text.encode('utf-8')).hexdigest())
methods.append(hashlib.sha384(text.encode('utf-8')).hexdigest())
methods.append(hashlib.sha512(text.encode('utf-8')).hexdigest())
methods.append(hashlib.md5(text.encode('utf-8')).hexdigest())

print("Plain Text:       " + text \
	+ "\nSHA1   Encrypted: " + methods[0] \
	+ "\nSHA224 Encrypted: " + methods[1] \
	+ "\nSHA256 Encrypted: " + methods[2] \
	+ "\nSHA384 Encrypted: " + methods[3] \
	+ "\nSHA512 Encrypted: " + methods[4] \
	+ "\nMD5    Encrypted: " + methods[5]) 