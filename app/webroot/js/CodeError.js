

window.onerror = function (sMessage, sUrl, sLine) {
    captureExceptionFeb(sMessage, sUrl, sLine);
}
function captureExceptionFeb(sMessage, sUrl, sLine) {
    console.error("Błąd:\n" + sMessage + "\nURL: " + sUrl + "\n Numer wiersza: " + sLine);
    //console.log(log);
    var post = {};
    post.name = 'onerror';
    post.message = sMessage;
    post.url = sUrl;
    post.line = sLine;
    post.href = window.location.href;
    var success = function (data) {
        console.info(data.return.message);
    };
    $.ajax({
        type: "POST",
        url: '/code_errors/add.json',
        data: post,
        success: success,
        dataType: 'json'
    });
    return true;
}