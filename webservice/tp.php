<?php

echo sha1("spider97");
// sends the current info.
// get  the info from DB. if row is present then proceed further or return  status :404 ,message : User not found
// if row is present then check login status , if no then status : 403, message : logout from other devices
// if login status yes then return user Id . status : 200 , message : login successfull
