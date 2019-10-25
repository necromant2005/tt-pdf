#!/bin/bash

echo $1 | base64 --decode > /mnt/script.js
echo $2 | base64 --decode > /mnt/input.html
casperjs --ssl-protocol=TLSv1 --ignore-ssl-errors=yes /mnt/script.js --input=/mnt/input.html --output=/mnt/output.pdf
echo "GNsWoiq7mSOXX5KI2fKXIOy8PlMokuxQ7PAkVRh6xTTkOtREwp"
cat /mnt/output.pdf
