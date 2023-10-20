<?php
// Set it to true when you will upload this website on cpanel
app::setProduction(false);

// Set database 
app::setHost("localhost");
app::setUsername("root");
app::setPassword("");
app::setDatabase("ptcl");
app::setConnection();

// Set timezone
app::setTimeZone("Asia/Karachi");

// Set url
app::setUrl("default");

// set session
app::startSession(true);

