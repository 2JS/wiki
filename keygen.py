#!/usr/bin/python
import random

pool = "0123456789abcdefghijklmnopqrstuvwxyz"

def keygen(length):
    return "".join([random.choice(pool) for _ in range(length)])
print("WG_SECRETKEY=%s" % keygen(64))
print("WG_UPGRADEKEY=%s" % keygen(16))
