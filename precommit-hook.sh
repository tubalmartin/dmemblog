#!/bin/sh
files=`git diff --cached --name-status`
re="scripts.js style.css"
if [[ $files =~ $re ]]
then
  echo "Creating files"
  grunt build-prod
  git add $re
fi