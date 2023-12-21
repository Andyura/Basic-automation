*** Settings ***
Library           SeleniumLibrary

*** variables ***


*** Test Cases ***

testcase-login-1
    Open Browser    http://localhost/Testing-QA/Sample-Web/    chrome
    Page Should Contain Element   xpath://input[@name='username']
    input text        name:username       admin
    Input Text    name:password    admin
    Click Element     xpath://button[@type='submit']
    Close Browser


testcase-login-2
    Open Browser    http://localhost/Testing-QA/Sample-Web/    chrome
    Page Should Contain Element   xpath://input[@name='username']
    input text        name:username       admin
    Input Text    name:password    admina
    Click Element     xpath://button[@type='submit']
    Close Browser