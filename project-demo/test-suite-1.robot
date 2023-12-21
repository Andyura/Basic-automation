*** Settings ***
Library           SeleniumLibrary

*** variables ***
${BROWSER}     chrome
${HOST}    http://localhost/Testing-QA/web/

${EMAIL}    admin
${PASS-1}    admin    # correct password
${PASS-2}    aprianx    # wrong password

${NEW}    Test001
${PW}    Test001

*** Test Cases ***

# login
# positive test
testcase-1
    Login Success
    Close Browser    

# negative test
testcase-2
    Open Browser    ${HOST}    ${BROWSER}
    Page Should Contain Element   xpath://input[@name='username']
    input text        name:username       ${EMAIL}
    input text        name:password    ${PASS-2}
    Click Element     xpath://button[@type='submit']
    Close Browser 

# logout
testcase-3
    Login Success
    Click Element     xpath://a[@class='menuNavbar' and @href='logout.php']
    Page Should Contain Element    xpath://body//h2[contains(text(), 'Login')]
    Close Browser 

#post job
testcase-4
    Login Success
    Page Should Contain Element   xpath://input[@name='newUsername']
    input text        name:newUsername       ${NEW}
    input text        name:newPassword       ${PW}
    Click Element     xpath://button[@type='submit']
    Close Browser 
    

*** Keywords ***

Scroll Down Until End
    ${previous_height}=    Execute Javascript    return document.body.scrollHeight;
    FOR  ${i}    IN RANGE    10
        Execute Javascript    window.scrollTo(0, document.body.scrollHeight);
        Sleep    1s
        ${current_height}=    Execute Javascript    return document.body.scrollHeight;
        Exit For Loop If    '${current_height}' == '${previous_height}'
        ${previous_height}=    Set Variable    ${current_height}
        Sleep    2s
    END

Login Success
    Open Browser    ${HOST}    ${BROWSER}
    Page Should Contain Element   xpath://input[@name='username']
    input text        name:username       ${EMAIL}
    input text        name:password    ${PASS-1}
    Click Element     xpath://button[@type='submit']