class mx.containers.Window extends mx.core.ScrollView
{
    var destroyChildAt, __contentPath, __get__contentPath, boundingBox_mc, _parent, modalWindow, swapDepths, _xmouse, regX, _ymouse, regY, onMouseMove, move, back_mc, createClassObject, depth, __get__title, titleStyleDeclaration, button_mc, validateNow, redraw, invalidate, _title, _child0, border_mc, __get__width, __get__height, __set__contentPath, size, vScroller, hScroller, closeButton, dispatchEvent, __set__title;
    function Window()
    {
        super();
    } // End of the function
    function set contentPath(scrollableContent)
    {
        if (!initializing)
        {
            if (scrollableContent == undefined)
            {
                this.destroyChildAt(0);
            }
            else
            {
                if (this[mx.core.View.childNameBase + 0] != undefined)
                {
                    this.destroyChildAt(0);
                } // end if
                this.createChild(scrollableContent, "content", {styleName: this});
            } // end if
        } // end else if
        __contentPath = scrollableContent;
        //return (this.contentPath());
        null;
    } // End of the function
    function get contentPath()
    {
        return (__contentPath);
    } // End of the function
    function init(Void)
    {
        super.init();
        boundingBox_mc._visible = false;
        boundingBox_mc._width = boundingBox_mc._height = 0;
    } // End of the function
    function delegateClick(obj)
    {
        _parent.dispatchEvent({type: "click"});
    } // End of the function
    function startDragging(Void)
    {
        if (modalWindow == undefined)
        {
            var _loc2 = _parent.createChildAtDepth("BoundingBox", mx.managers.DepthManager.kTop, {_visible: false});
            this.swapDepths(_loc2);
            _loc2.removeMovieClip();
        } // end if
        regX = _xmouse;
        regY = _ymouse;
        onMouseMove = dragTracking;
    } // End of the function
    function stopDragging(Void)
    {
        delete this.onMouseMove;
    } // End of the function
    function dragTracking()
    {
        var _loc5 = _parent._xmouse - regX;
        var _loc4 = _parent._ymouse - regY;
        var _loc3 = 5;
        var _loc2 = mx.managers.SystemManager.__get__screen();
        if (_loc5 < _loc2.x - regX + _loc3)
        {
            _loc5 = _loc2.x - regX + _loc3;
        } // end if
        if (_loc5 > _loc2.width + _loc2.x - (regX + _loc3))
        {
            _loc5 = _loc2.width + _loc2.x - (regX + _loc3);
        } // end if
        if (_loc4 < _loc2.y - regY + _loc3)
        {
            _loc4 = _loc2.y - regY + _loc3;
        } // end if
        if (_loc4 > _loc2.height + _loc2.y - (regY + _loc3))
        {
            _loc4 = _loc2.height + _loc2.y - (regY + _loc3);
        } // end if
        this.move(_loc5, _loc4);
        updateAfterEvent();
    } // End of the function
    function createChildren(Void)
    {
        super.createChildren();
        if (back_mc == undefined)
        {
            this.createClassObject(mx.core.UIObject, "back_mc", 1);
            back_mc.createObject(skinTitleBackground, "back_mc", 0);
        } // end if
        back_mc.visible = false;
        depth = 3;
        var _loc6 = new Object();
        back_mc.useHandCursor = false;
        back_mc.onPress = function ()
        {
            if (_parent.enabled)
            {
                _parent.startDragging();
            } // end if
        };
        back_mc.onDragOut = back_mc.onRollOut = back_mc.onReleaseOutside = back_mc.onRelease = function ()
        {
            var _loc2 = _parent;
            _loc2.stopDragging();
        };
        back_mc.tabEnabled = false;
        if (back_mc.title_mc == undefined)
        {
            back_mc.createLabel("title_mc", 1, this.__get__title());
            var _loc4 = back_mc.title_mc;
            if (titleStyleDeclaration == undefined)
            {
                _loc4.fontSize = 10;
                _loc4.color = 16777215;
                _loc4.fontWeight = "bold";
            }
            else
            {
                _loc4.styleName = titleStyleDeclaration;
            } // end else if
            _loc4.invalidateStyle();
        }
        else
        {
            back_mc.title_mc.text = title;
        } // end else if
        var _loc3 = new Object();
        _loc3.falseUpSkin = skinCloseUp;
        _loc3.falseOverSkin = skinCloseOver;
        _loc3.falseDownSkin = skinCloseDown;
        _loc3.falseDisabledSkin = skinCloseDisabled;
        _loc3.tabEnabled = false;
        this.createClassObject(mx.controls.SimpleButton, "button_mc", 2, _loc3);
        button_mc.clickHandler = delegateClick;
        button_mc.__set__visible(false);
        if (validateNow)
        {
            this.redraw(true);
        }
        else
        {
            this.invalidate();
        } // end else if
    } // End of the function
    function get title()
    {
        return (_title);
    } // End of the function
    function set title(s)
    {
        _title = s;
        back_mc.title_mc.text = s;
        if (!initializing)
        {
            this.draw();
        } // end if
        //return (this.title());
        null;
    } // End of the function
    function setEnabled(enable)
    {
        super.setEnabled(enable);
        button_mc.enabled = enable;
        _child0.enabled = enable;
    } // End of the function
    function getComponentCount(Void)
    {
        return (1);
    } // End of the function
    function getComponentRect(container)
    {
        if (container == 1)
        {
            var _loc3 = border_mc.__get__borderMetrics();
            var _loc2 = new Object();
            _loc2.x = _loc3.left;
            _loc2.y = _loc3.top + back_mc.height;
            _loc2.width = this.__get__width() - _loc2.x - _loc3.right;
            _loc2.height = this.__get__height() - _loc2.y - _loc3.bottom;
            return (_loc2);
        } // end if
        return;
    } // End of the function
    function draw(Void)
    {
        if (initializing)
        {
            initializing = false;
            if (__contentPath != undefined)
            {
                this.__set__contentPath(__contentPath);
            } // end if
            _child0.visible = true;
            border_mc.__set__visible(true);
            back_mc.visible = true;
        } // end if
        this.size();
    } // End of the function
    function getViewMetrics(Void)
    {
        var _loc3 = super.getViewMetrics();
        _loc3.top = _loc3.top + back_mc.height;
        return (_loc3);
    } // End of the function
    function doLayout(Void)
    {
        super.doLayout();
        var _loc3 = border_mc.__get__borderMetrics();
        _loc3.right = _loc3.right + (vScroller.__get__visible() == true ? (vScroller.__get__width()) : (0));
        _loc3.bottom = _loc3.bottom + (hScroller.__get__visible() == true ? (hScroller.__get__height()) : (0));
        var _loc4 = _loc3.left;
        var _loc6 = _loc3.top;
        back_mc.move(_loc4, _loc6);
        back_mc.back_mc.setSize(this.__get__width() - _loc4 - _loc3.right, back_mc.height);
        _child0.move(_loc4, _loc6 + back_mc.height);
        if (_child0.size != mx.core.UIObject.prototype.size)
        {
            _child0.setSize(this.__get__width() - _loc4 - _loc3.right, this.__get__height() - _loc6 - back_mc.height - _loc3.bottom);
        } // end if
        button_mc.__set__visible(closeButton == true);
        button_mc.move(this.__get__width() - _loc4 - _loc4 - button_mc.__get__width(), (back_mc.height - button_mc.__get__height()) / 2 + _loc6);
        var _loc7 = back_mc.title_mc.textHeight;
        var _loc5 = (back_mc.height - _loc7 - 4) / 2;
        back_mc.title_mc.move(_loc5, _loc5 - 1);
        back_mc.title_mc.setSize(this.__get__width() - _loc5 - _loc5, _loc7 + 4);
    } // End of the function
    function createChild(id, name, props)
    {
        loadingChild = true;
        var _loc3 = super.createChild(id, name, props);
        loadingChild = false;
        return (_loc3);
    } // End of the function
    function childLoaded(obj)
    {
        super.childLoaded(obj);
        if (loadingChild)
        {
            this.dispatchEvent({type: "complete", current: obj.getBytesLoaded(), total: obj.getBytesTotal()});
        } // end if
    } // End of the function
    static var symbolName = "Window";
    static var symbolOwner = mx.containers.Window;
    static var version = "2.0.2.127";
    var className = "Window";
    static var skinIDBorder = 0;
    static var skinIDTitleBackground = 1;
    static var skinIDForm = 2;
    var idNames = new Array("border_mc", "back_mc", "content");
    var skinTitleBackground = "TitleBackground";
    var skinCloseUp = "CloseButtonUp";
    var skinCloseOver = "CloseButtonOver";
    var skinCloseDown = "CloseButtonDown";
    var skinCloseDisabled = "CloseButtonDisabled";
    var clipParameters = {title: 1, contentPath: 1, closeButton: 1};
    static var mergedClipParameters = mx.core.UIObject.mergeClipParameters(mx.containers.Window.prototype.clipParameters, mx.core.ScrollView.prototype.clipParameters);
    var initializing = true;
    var loadingChild = false;
} // End of Class
