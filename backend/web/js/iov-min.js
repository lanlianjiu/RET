+ function ($) {
    var cfg = {
        //server_: "http://localhost/TES/backend/web/",
        //server_: "http://192.168.184.128/TES/backend/web/",
        user: 'TES_USERINFO',
        auth: 'auth',
    }
    $.cfg = cfg;
    $.ajaxSetup({
        data: {

        },
        success: function (data) {},
        error: function (xhr, status, e) {
            var pathName = window.top.location.pathname.substring(0, window.top.location.pathname.substr(1).indexOf('/') + 1);
            var localPath = window.top.location.origin;
            var rootPath = localPath + localPath;

            if (xhr.status == 401) {
                if (window.top == window.self) { //不存在父页面
                    window.location.replace("/login.php");
                } else {
                    window.top.location.replace($.cfg.server_ + "/login.php");
                }
            } else if (xhr.status == 405) {
                alert(xhr.responseText)
            }
        }
    })
}(jQuery);
/** b-iov-utils start 基本函数**/
+
(function ($) {
    function md5(str) {
        if (null === str) {
            return null;
        }
        var xl;
        var rotateLeft = function (lValue, iShiftBits) {
            return lValue << iShiftBits | lValue >>> 32 - iShiftBits;
        };
        var addUnsigned = function (lX, lY) {
            var lX4, lY4, lX8, lY8, lResult;
            lX8 = lX & 2147483648;
            lY8 = lY & 2147483648;
            lX4 = lX & 1073741824;
            lY4 = lY & 1073741824;
            lResult = (lX & 1073741823) + (lY & 1073741823);
            if (lX4 & lY4) {
                return lResult ^ 2147483648 ^ lX8 ^ lY8;
            }
            if (lX4 | lY4) {
                if (lResult & 1073741824) {
                    return lResult ^ 3221225472 ^ lX8 ^ lY8;
                } else {
                    return lResult ^ 1073741824 ^ lX8 ^ lY8;
                }
            } else {
                return lResult ^ lX8 ^ lY8;
            }
        };
        var _F = function (x, y, z) {
            return x & y | ~x & z;
        };
        var _G = function (x, y, z) {
            return x & z | y & ~z;
        };
        var _H = function (x, y, z) {
            return x ^ y ^ z;
        };
        var _I = function (x, y, z) {
            return y ^ (x | ~z);
        };
        var _FF = function (a, b, c, d, x, s, ac) {
            a = addUnsigned(a, addUnsigned(addUnsigned(_F(b, c, d), x), ac));
            return addUnsigned(rotateLeft(a, s), b);
        };
        var _GG = function (a, b, c, d, x, s, ac) {
            a = addUnsigned(a, addUnsigned(addUnsigned(_G(b, c, d), x), ac));
            return addUnsigned(rotateLeft(a, s), b);
        };
        var _HH = function (a, b, c, d, x, s, ac) {
            a = addUnsigned(a, addUnsigned(addUnsigned(_H(b, c, d), x), ac));
            return addUnsigned(rotateLeft(a, s), b);
        };
        var _II = function (a, b, c, d, x, s, ac) {
            a = addUnsigned(a, addUnsigned(addUnsigned(_I(b, c, d), x), ac));
            return addUnsigned(rotateLeft(a, s), b);
        };
        var convertToWordArray = function (str) {
            var lWordCount;
            var lMessageLength = str.length;
            var lNumberOfWords_temp1 = lMessageLength + 8;
            var lNumberOfWords_temp2 = (lNumberOfWords_temp1 - lNumberOfWords_temp1 % 64) / 64;
            var lNumberOfWords = (lNumberOfWords_temp2 + 1) * 16;
            var lWordArray = new Array(lNumberOfWords - 1);
            var lBytePosition = 0;
            var lByteCount = 0;
            while (lByteCount < lMessageLength) {
                lWordCount = (lByteCount - lByteCount % 4) / 4;
                lBytePosition = lByteCount % 4 * 8;
                lWordArray[lWordCount] = lWordArray[lWordCount] | str.charCodeAt(lByteCount) << lBytePosition;
                lByteCount++;
            }
            lWordCount = (lByteCount - lByteCount % 4) / 4;
            lBytePosition = lByteCount % 4 * 8;
            lWordArray[lWordCount] = lWordArray[lWordCount] | 128 << lBytePosition;
            lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
            lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
            return lWordArray;
        };
        var wordToHex = function (lValue) {
            var wordToHexValue = "",
                wordToHexValue_temp = "",
                lByte, lCount;
            for (lCount = 0; lCount <= 3; lCount++) {
                lByte = lValue >>> lCount * 8 & 255;
                wordToHexValue_temp = "0" + lByte.toString(16);
                wordToHexValue = wordToHexValue + wordToHexValue_temp.substr(wordToHexValue_temp.length - 2, 2);
            }
            return wordToHexValue;
        };
        var x = [],
            k, AA, BB, CC, DD, a, b, c, d, S11 = 7,
            S12 = 12,
            S13 = 17,
            S14 = 22,
            S21 = 5,
            S22 = 9,
            S23 = 14,
            S24 = 20,
            S31 = 4,
            S32 = 11,
            S33 = 16,
            S34 = 23,
            S41 = 6,
            S42 = 10,
            S43 = 15,
            S44 = 21;
        x = convertToWordArray(str);
        a = 1732584193;
        b = 4023233417;
        c = 2562383102;
        d = 271733878;
        xl = x.length;
        for (k = 0; k < xl; k += 16) {
            AA = a;
            BB = b;
            CC = c;
            DD = d;
            a = _FF(a, b, c, d, x[k + 0], S11, 3614090360);
            d = _FF(d, a, b, c, x[k + 1], S12, 3905402710);
            c = _FF(c, d, a, b, x[k + 2], S13, 606105819);
            b = _FF(b, c, d, a, x[k + 3], S14, 3250441966);
            a = _FF(a, b, c, d, x[k + 4], S11, 4118548399);
            d = _FF(d, a, b, c, x[k + 5], S12, 1200080426);
            c = _FF(c, d, a, b, x[k + 6], S13, 2821735955);
            b = _FF(b, c, d, a, x[k + 7], S14, 4249261313);
            a = _FF(a, b, c, d, x[k + 8], S11, 1770035416);
            d = _FF(d, a, b, c, x[k + 9], S12, 2336552879);
            c = _FF(c, d, a, b, x[k + 10], S13, 4294925233);
            b = _FF(b, c, d, a, x[k + 11], S14, 2304563134);
            a = _FF(a, b, c, d, x[k + 12], S11, 1804603682);
            d = _FF(d, a, b, c, x[k + 13], S12, 4254626195);
            c = _FF(c, d, a, b, x[k + 14], S13, 2792965006);
            b = _FF(b, c, d, a, x[k + 15], S14, 1236535329);
            a = _GG(a, b, c, d, x[k + 1], S21, 4129170786);
            d = _GG(d, a, b, c, x[k + 6], S22, 3225465664);
            c = _GG(c, d, a, b, x[k + 11], S23, 643717713);
            b = _GG(b, c, d, a, x[k + 0], S24, 3921069994);
            a = _GG(a, b, c, d, x[k + 5], S21, 3593408605);
            d = _GG(d, a, b, c, x[k + 10], S22, 38016083);
            c = _GG(c, d, a, b, x[k + 15], S23, 3634488961);
            b = _GG(b, c, d, a, x[k + 4], S24, 3889429448);
            a = _GG(a, b, c, d, x[k + 9], S21, 568446438);
            d = _GG(d, a, b, c, x[k + 14], S22, 3275163606);
            c = _GG(c, d, a, b, x[k + 3], S23, 4107603335);
            b = _GG(b, c, d, a, x[k + 8], S24, 1163531501);
            a = _GG(a, b, c, d, x[k + 13], S21, 2850285829);
            d = _GG(d, a, b, c, x[k + 2], S22, 4243563512);
            c = _GG(c, d, a, b, x[k + 7], S23, 1735328473);
            b = _GG(b, c, d, a, x[k + 12], S24, 2368359562);
            a = _HH(a, b, c, d, x[k + 5], S31, 4294588738);
            d = _HH(d, a, b, c, x[k + 8], S32, 2272392833);
            c = _HH(c, d, a, b, x[k + 11], S33, 1839030562);
            b = _HH(b, c, d, a, x[k + 14], S34, 4259657740);
            a = _HH(a, b, c, d, x[k + 1], S31, 2763975236);
            d = _HH(d, a, b, c, x[k + 4], S32, 1272893353);
            c = _HH(c, d, a, b, x[k + 7], S33, 4139469664);
            b = _HH(b, c, d, a, x[k + 10], S34, 3200236656);
            a = _HH(a, b, c, d, x[k + 13], S31, 681279174);
            d = _HH(d, a, b, c, x[k + 0], S32, 3936430074);
            c = _HH(c, d, a, b, x[k + 3], S33, 3572445317);
            b = _HH(b, c, d, a, x[k + 6], S34, 76029189);
            a = _HH(a, b, c, d, x[k + 9], S31, 3654602809);
            d = _HH(d, a, b, c, x[k + 12], S32, 3873151461);
            c = _HH(c, d, a, b, x[k + 15], S33, 530742520);
            b = _HH(b, c, d, a, x[k + 2], S34, 3299628645);
            a = _II(a, b, c, d, x[k + 0], S41, 4096336452);
            d = _II(d, a, b, c, x[k + 7], S42, 1126891415);
            c = _II(c, d, a, b, x[k + 14], S43, 2878612391);
            b = _II(b, c, d, a, x[k + 5], S44, 4237533241);
            a = _II(a, b, c, d, x[k + 12], S41, 1700485571);
            d = _II(d, a, b, c, x[k + 3], S42, 2399980690);
            c = _II(c, d, a, b, x[k + 10], S43, 4293915773);
            b = _II(b, c, d, a, x[k + 1], S44, 2240044497);
            a = _II(a, b, c, d, x[k + 8], S41, 1873313359);
            d = _II(d, a, b, c, x[k + 15], S42, 4264355552);
            c = _II(c, d, a, b, x[k + 6], S43, 2734768916);
            b = _II(b, c, d, a, x[k + 13], S44, 1309151649);
            a = _II(a, b, c, d, x[k + 4], S41, 4149444226);
            d = _II(d, a, b, c, x[k + 11], S42, 3174756917);
            c = _II(c, d, a, b, x[k + 2], S43, 718787259);
            b = _II(b, c, d, a, x[k + 9], S44, 3951481745);
            a = addUnsigned(a, AA);
            b = addUnsigned(b, BB);
            c = addUnsigned(c, CC);
            d = addUnsigned(d, DD);
        }
        var temp = wordToHex(a) + wordToHex(b) + wordToHex(c) + wordToHex(d);
        return temp.toLowerCase();
    };

    function uuid(len, radix) {
        var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');
        var uuid = [],
            i;
        radix = radix || chars.length;

        if (len) {
            for (i = 0; i < len; i++) uuid[i] = chars[0 | Math.random() * radix];
        } else {
            var r;
            uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
            uuid[14] = '4';

            for (i = 0; i < 36; i++) {
                if (!uuid[i]) {
                    r = 0 | Math.random() * 16;
                    uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r];
                }
            }
        }

        return uuid.join('');
    };

    function getUrlParams(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    }

    function windowHeight() {
        var de = document.documentElement;
        return self.innerHeight || (de && de.clientHeight) || document.body.clientHeight;
    };
    var utils = {
        md5: md5,
        uuid: uuid,
        getUrlParams: getUrlParams,
        windowHeight: windowHeight,
        pad: function (tbl) {
            return function (num, n) {
                return (0 >= (n = n - num.toString().length)) ? num : (tbl[n] || (tbl[n] = Array(n + 1).join(0))) + num;
            }
        }([]),
    };
    $.utils = utils;
})(jQuery);

/** b-iov-utils end**/
+
/*基本校验函数*/
(function () {
    $.extend(String.prototype, {
        isPositiveInteger: function () {
            return new RegExp(/^[1-9]\d*$/).test(this)
        },
        isInteger: function () {
            return new RegExp(/^\d+$/).test(this)
        },
        isNumber: function () {
            return new RegExp(/^([-]{0,1}(\d+)[\.]+(\d+))|([-]{0,1}(\d+))$/).test(this)
        },
        includeChinese: function () {
            return new RegExp(/[\u4E00-\u9FA5]/).test(this)
        },
        trim: function () {
            return this.replace(/(^\s*)|(\s*$)|\r|\n/g, "")
        },
        startsWith: function (a) {
            return 0 === this.indexOf(a)
        },
        endsWith: function (a) {
            var b = this.length - a.length;
            return b >= 0 && this.lastIndexOf(a) === b
        },
        replaceAll: function (a, b) {
            return this.replace(new RegExp(a, "gm"), b)
        }
    });
    $.fn.serializeObject = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery); +
/**bootstrap-dialog-modal 自定义弹出框居中**/
function ($) {
    $(document).on("show.bs.modal", ".modal", function () {
        $(this).draggable({
            handle: ".modal-header"
        });

        if (!($(this).attr("data-model-overflow"))) {

            $(this).css("overflow-y", "hidden"); // 防止出现滚动条
            //模态框垂直居中
            $(this).css('display', 'block'); // 关键代码，如没将modal设置为 block，则$modala_dialog.height() 为零
            var modalHeight = ($(window).height() / 2) - ($('.modal-dialog').height() / 2);
            $(this).find('.modal-dialog').css({
                'margin-top': modalHeight
            });
        };


    });
}(jQuery); +
(function ($) {
    var Dialog = function () {}
    Dialog.prototype.Success = function (message, callback) {
        var dlg = BootstrapDialog.show({
            type: 'type-success',
            title: '提示信息',
            message: message,
            closable: true,
            draggable: true,
            onhidden: callback,
        });
        setTimeout(function () {
            dlg.close();
        }, 1500);
    }

    Dialog.prototype.Info = function (message) {
        var dlg = BootstrapDialog.show({
            type: 'type-info',
            title: '提示信息',
            message: message,
            closable: true,
            draggable: true,
        })
        setTimeout(function () {
            dlg.close();
        }, 1500);
    }

    Dialog.prototype.Warn = function (message) {
        var dlg = BootstrapDialog.show({
            type: 'type-warning',
            title: '提示信息',
            message: message,
            closable: true,
            draggable: true,
        })
        setTimeout(function () {
            dlg.close();
        }, 1500);
    }
    Dialog.prototype.Confirm = function (message, callback) {
        BootstrapDialog.confirm({
            type: 'type-primary',
            title: '提示信息',
            message: message,
            closable: false,
            draggable: true,
            btnCancelLabel: '否',
            btnOKLabel: '是',
            btnOKClass: 'btn-primary',
            callback: callback
        })
    }
    $.dialog = new Dialog();
})(jQuery);
/**bootstrap-dialog-modal**/
+
/**
 * adaptionHeight start 自适应高度
 */
(function ($) {
    function initLoad() {
        $("[data-adaptionHeight]").each(function () {
            var $this = $(this)
            var val = $this.data()['adaptionheight'];
            if (!String(val).isInteger()) {
                val = 0;
            }
            $this.css("overflow-y", "auto");
            $this.css("overflow-x", "hidden");
            $this.css("height", ($.utils.windowHeight() - $this.offset().top - val) + "px")
        })
    }

    $(document).ready(function () {
        initLoad();
    })
})(jQuery);
/**
 * adaptionHeight end
 */+
    /**bootstrap-table 初始化**/
    function ($) {

        
    
    }(jQuery);