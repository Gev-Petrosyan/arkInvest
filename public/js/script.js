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

    function createTableItem(txhash, block, value, fee, from, to, coin) {
        let link = (coin == 'BTC') ? 'https://www.blockchain.com/explorer/transactions/btc/' + txhash 
        : 'https://etherscan.io/tx/' + txhash;
        let row = `<div class="transaction-item">
            <p class="txhash"  style="min-width:35%;max-width:35%">
                ${from.substring(0, 12)+'...'} <img src="images/FlA8che.png" style="width:14px"> ${to.substring(0, 12)+'...'}<br>
                ${to.substring(0, 12)+'...'} <img src="images/FlA8che.png" style="width:14px"> ${from.substring(0, 12)+'...'}
            </p>
            <p class="value" style="min-width:25%;max-width:25%">
                ${value + ' ' + coin} <br>
                ${value / 2 + ' ' + coin}
            </p>
            <p class="fee" style="min-width:20%;max-width:20%">
                <a style="color: #4287f5" href="${link}" target="_blank">Open transaction</a>
            </p>
            <p class="status" style="min-width:auto;max-width:none">Completed</p>
        </div>`;
        $(row).hide().prependTo(".transaction-content").fadeIn("slow");
        $('.transaction-item:eq(5)').remove();
    }

    $.ajax({
        url: "https://api.blockcypher.com/v1/btc/main/txs?limit=20",
        type: "GET",
        success: function(response) {
            for(let i = 0; i < response.length; i++) {
                let transaction = response[i];
                let txhash = transaction.hash;
                let block = transaction.block_height;
                let from = transaction.inputs[0].addresses[0];
                let to = transaction.outputs[0].addresses[0];
                let value = parseInt(transaction.outputs[0].value) / 100000000;
                let fee = transaction.fees;
                value = String(value).substring(0, 4);
                if (value == '0.00') value = '0';
                if (value > 0.2) createTableItem(txhash, block, value, fee, from, to, 'BTC');
            }
        }
    });
    
    $.ajax({
        url: "https://api.blockcypher.com/v1/eth/main/txs?limit=20",
        type: "GET",
        success: function(response) {
            for(let i = 0; i < response.length; i++) {
                let transaction = response[i];
                let txhash = '0x' + transaction.hash;
                let block = transaction.block_height;
                let from = '0x' + transaction.inputs[0].addresses[0];
                let to = '0x' + transaction.outputs[0].addresses[0];
                let value = parseInt(transaction.outputs[0].value) / 1000000000000000000;
                let fee = 'ETH';
                value = String(value).substring(0, 4);
                if (value == '0.00') value = '0';
                if (value > 1) createTableItem(txhash, block, value, fee, from, to, 'ETH');
            }
        }
    });

    setInterval(function () {
        $.ajax({
            url: "https://api.blockcypher.com/v1/btc/main/txs?limit=15",
            type: "GET",
            success: function(response) {
                for(let i = 0; i < response.length; i++) {
                    let transaction = response[i];
                    let txhash = transaction.hash;
                    let block = transaction.block_height;
                    let from = transaction.inputs[0].addresses[0];
                    let to = transaction.outputs[0].addresses[0];
                    let value = parseInt(transaction.outputs[0].value) / 100000000;
                    let fee = transaction.fees;
                    value = String(value).substring(0, 4);
                    if (value == '0.00') value = '0';
                    if (value > 0.2) createTableItem(txhash, block, value, fee, from, to, 'BTC');
                }
            }
        });
        $.ajax({
            url: "https://api.blockcypher.com/v1/eth/main/txs?limit=15",
            type: "GET",
            success: function(response) {
                for(let i = 0; i < response.length; i++) {
                    let transaction = response[i];
                    let txhash = '0x' + transaction.hash;
                    let block = transaction.block_height;
                    let from = '0x' + transaction.inputs[0].addresses[0];
                    let to = '0x' + transaction.outputs[0].addresses[0];
                    let value = parseInt(transaction.outputs[0].value) / 1000000000000000000;
                    let fee = 'ETH';
                    value = String(value).substring(0, 4);
                    if (value == '0.00') value = '0';
                    if (value > 1) createTableItem(txhash, block, value, fee, from, to, 'ETH');
                }
            }
        });
    }, 25000);
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
