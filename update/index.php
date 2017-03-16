<?php 

print("Initiating pull request\n<br/>"); 

//system("git pull");
//shell_exec("git pull");
//shell_exec("git pull");

system("printf \"pre-test<br/>\"");


system('whoami');
print('<br/>');
system("cd");
print('<br/>');
system("pwd");
print('<br/>');
passthru("ls -l");
print('<br/>');

print("first test<br/>");
//system('git');
system('git --version');
//print("<br/>second test<br/>");
//system('git --git-dir=/gaia/class/student/gutierrl/html status 2>&1');
//printf("<br/>");
system('git status 2>&1');
//printf("<br/>");
//system('ls -l \"/gaia/class/student/gutierrl/html/\"');
//print("<br/>");
//system('cd .. 2>&1');
print("<br/>");
system('git status 2>&1');
print("<br/>");
system('git reset --hard HEAD 2>&1');
print("<br/>");
system('/usr/bin/git pull 2>&1');



system("printf \"<br/>\"");

system("printf \"post-test<br/>\"");

print('Finished pull request');

?>
