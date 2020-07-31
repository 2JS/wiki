#!/usr/bin/python
import random

pool = "0123456789abcdefghijklmnopqrstuvwxyz"

def keygen(length):
    return "".join([random.choice(pool) for _ in range(length)])
print("$wgSecretKey=\t%s" % keygen(64))
print("$wgUpgradeKey=\t%s" % keygen(16))
