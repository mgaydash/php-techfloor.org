(function($){
    $.widget("tf.codeModule", {
        _ajaxCall: function(callback, data, url){
			var that = this;
			var d = new $.Deferred();
			var success = true;
			$.ajax({
				cache: false,
				complete: function(jqXHR, textStatus){
					d.resolve(success);
				},
				data: data,
				dataType: "text",
				error: function(jqXHR, textStatus, errorThrown){
					success = false;
				},
				success: function(data, textStatus, jqXHR){
					callback(data, that);
				},
				url: url
			});
			return d.promise();
		},
		_isEmptyString: function(string){
			return string === "";
		},
		_isValidEmail: function(string){
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(string);
		},
		_keydownTimeout: function(inputObj, func, timeout, clearIfEmpty){
			inputObj.keydown(function(){
				clearTimeout(window.timeoutFunc);
				timeoutFunc = setTimeout(
					function(){
						func();
					},
					timeout
				);
				if(clearIfEmpty){
					if(inputObj.val().length === 0){
						clearTimeout(timeoutFunc);
					}
				}
			});
		}
    });
})(jQuery);
(function($){
	var instanceNum = 0;
	$.widget("tf.baseForm", $.tf.codeModule, {
		options: {
			htmlTemplateSel: undefined, //OVERRIDE
			//element selectors
			_targetSel: undefined,
			//element objects
			_divTitleBarSel: ".tf_memberForm_titleBar",
			_formContainer: undefined,
			_htmlTemplate: undefined,
			//misc
			_classString: undefined,
			_isDisplayed: false,
			_isSelected: false
		},
		_addZIndexingEventHandlers: function(){
			var that = this;
			var options = that.options;
			//fire event when form is clicked
			options._formContainer.mousedown(function(e){
				$(document).trigger("formSelected");
				options._formContainer.css("z-index", "101");
				options._isSelected = true;
			});
			//handle event
			$(document).bind("formSelected", function(){
				options._formContainer.css("z-index", "100");
				options._isSelected = false;
			});
		},
		_clearForm: function(){
			var that = this;
			var options = that.options;
			options._formContainer.find("input").val("");
		},
		_closeForm: function(){
			var that = this;
			var options = that.options;
			options._formContainer.css("display", "none");
			that._clearForm();
			options._isDisplayed = false;
		},
		_create: function(){
			var that = this;
			that._generateUniqueClass();
			that._getWidgetTargetElementSelector();
			that._makeFormContainer();
			that._addZIndexingEventHandlers();
			that._retrieveHtmlTemplateFromDom();
		},
		_displayForm: function(){
			var that = this;
			var options = that.options;
			options._formContainer.css("display", "inline-block");
			options._formContainer.trigger("mousedown");
			options._isDisplayed = true;
			options._isSelected = true;
		},
		_generateUniqueClass: function(){
			var that = this;
			var options = that.options;
			var s = "tf_" + that.widgetName + "_default_formContainer_" + instanceNum;
			options._classString = s;
			instanceNum++;
		},
		_getWidgetTargetElementSelector: function(){
			var that = this;
			var options = that.options;
			options._targetSel = that.element[0].nodeName;
		},
		_makeFormContainer: function(){
			var that = this;
			var options = that.options;
			options._formContainer = $("<div></div>");
			options._formContainer.draggable({
				handle: options._divTitleBarSel
			});
			//style form container
			options._formContainer.addClass(options._classString);
			options._formContainer.css("background", "#d0d0d0");
			options._formContainer.css("border", "3px solid black");
			options._formContainer.css("display", "none");
			options._formContainer.css("position", "absolute");
			options._formContainer.css("z-index", "100");
			//insert into dom
			$(options._targetSel).append(options._formContainer);
		},
		_retrieveHtmlTemplateFromDom: function(){
			var that = this;
			var options = that.options;
			options._htmlTemplate = $(options.htmlTemplateSel).remove();
			options._formContainer.html(options._htmlTemplate);
		}
	});
})(jQuery);
(function($){
    $.widget("tf.memberForm", $.tf.baseForm, {
		options: {
			//element objects
			_blockMain: undefined,
			_blockSuccess: undefined,
			_btnCancel: undefined,
			_btnSubmit: undefined,
			_inputEmail: undefined,
			_inputFName: undefined,
			_inputLName: undefined,
			_inputSummoner: undefined,
			//element selectors
			_blockMainSel: ".tf_memberForm_main",
			_blockMemberAddedSel: ".tf_memberForm_memberAdded",
			_inputEmailSel: ".tf_memberForm_email",
			_inputSummonerSel: ".tf_memberForm_summoner",
			_cancelBtnSel: ".tf_memberForm_cancelBtn",
			_fNameInputSel: ".tf_memberForm_fName",
			_lNameInputSel: ".tf_memberForm_lName",
			_submitBtnSel: ".tf_memberForm_subminBtn"
		},
		_addInnerWidgetEventHandlers: function(){
			var that = this;
			var options = that.options;
			//submit button
			options._btnSubmit.click(function(){
				that._submitMemberForm();
			});
			//close button
			options._btnCancel.click(function(){
				that._closeForm();
			});
			//enter key
			$(document).keyup(function(e){
				if(options._isDisplayed && options._isSelected)
					if(e.keyCode === 13)
						options._btnSubmit.click();
			});
			//keydown validation
			that._keydownTimeout(
				options._inputFName, 
				function(){
					that._validateFormFName();
				},
				1000,
				false
			);
			that._keydownTimeout(
				options._inputLName, 
				function(){
					that._validateFormLName();
				},
				1000,
				false
			);
			that._keydownTimeout(
				options._inputEmail, 
				function(){
					that._validateFormEmail();
				},
				1000,
				false
			);
		},
		_closeForm: function(){ //if form is closed while inputs have red borders, they need changed back
			var that = this;
			var options = that.options;
			that._super("_closeForm");
			options._formContainer.find("input").css("border", "1px solid black");
		},
		_makeElementObjectsFromTemplate: function(){
			var that = this;
			var options = that.options;
			options._blockMain = options._formContainer.find(options._blockMainSel);
			options._blockSuccess = options._formContainer.find(options._blockMemberAddedSel);
			options._btnCancel = options._formContainer.find(options._cancelBtnSel);
			options._btnSubmit = options._formContainer.find(options._submitBtnSel);
			options._inputEmail = options._formContainer.find(options._inputEmailSel);
			options._inputFName = options._formContainer.find(options._fNameInputSel);
			options._inputLName = options._formContainer.find(options._lNameInputSel);
			options._inputSummoner = options._formContainer.find(options._inputSummonerSel);
		},
		_submitMemberForm: function(){/*OVERRIDE*/},
        _validateAllFormFields: function(){
			var that = this;
			return(
				that._validateFormFName() &
				that._validateFormLName() &
				that._validateFormEmail()
			);
		},
		_validateFormEmail: function(){
			var that = this;
			var options = that.options;
			if(!that._isValidEmail(options._inputEmail.val())){
				options._inputEmail.css("border", "1px solid red");
				return false;
			}
			else{
				options._inputEmail.css("border", "1px solid black");
				return true;
			}
		},
		_validateFormFName: function(){
			var that = this;
			var options = that.options;
			if(that._isEmptyString(options._inputFName.val())){
				options._inputFName.css("border", "1px solid red");
				return false;
			}
			else{
				options._inputFName.css("border", "1px solid black");
				return true;
			}
		},
		_validateFormLName: function(){
			var that = this;
			var options = that.options;
			if(that._isEmptyString(options._inputLName.val())){
				options._inputLName.css("border", "1px solid red");
				return false;
			}	
			else{
				options._inputLName.css("border", "1px solid black");
				return true;
			}
		}
    });
})(jQuery);
(function($){
	$.widget("tf.addMemberForm", $.tf.memberForm, {
		options: {
			htmlTemplateSel: ".tf_addMemberForm",
			openButtonSel: undefined,
			//urls
			_addMemberUrl: "../controller/controller.php?action=addMember"
		},
		_addExoWidgetEventHandlers: function(){
			var that = this;
			var options = that.options;
			//open button
			$(options.openButtonSel).click(function(){
				that._displayForm();
				options._formContainer.css("left", $("#pageContent").offset()["left"] + 10 + "px");
				options._formContainer.css("top", $("#pageContent").offset()["top"] + 53 + "px");
			});
		},
		_create: function(){
			var that = this;
			//$.tf.baseForm.prototype._create.call(this);
			that._super("_create");
			that._makeElementObjectsFromTemplate();
			that._addInnerWidgetEventHandlers();
			that._addExoWidgetEventHandlers();
		},
		_submitMemberForm: function(){
			var that = this;
			var options = that.options;
			if(that._validateAllFormFields()){
				var data = "";
				data += "fName=" + options._inputFName.val();
				data += "&lName=" + options._inputLName.val();
				data += "&email=" + options._inputEmail.val();
				data += "&summoner=" + options._inputSummoner.val();
				that._ajaxCall(that._verifyMemberAdd, data, options._addMemberUrl);
			}
		},
		_verifyMemberAdd: function(data, that){
			var options = that.options;
			data = $.parseJSON(data);
			if(data.success){
				$(document).trigger("memberChanged");
				options._blockMain.slideUp(1000);//hide inputs
				options._blockSuccess.slideDown( //show the success div with callback to close the form and reset
					1000, 
					function(){
						setTimeout(
							function(){
								that._closeForm();
								options._blockMain.css("display", "block");
								options._blockSuccess.css("display", "none");
							},
							1500
						);
					}
				);
			}
		}
	});
})(jQuery);
(function($){
    $.widget("tf.editMemberForm", $.tf.memberForm, {
        options: {
            htmlTemplateSel: ".tf_editMemberForm",
			//json objects
			_memberJson: undefined,
			//urls
			_editMemberUrl: "../controller/controller.php?action=editMember",
			_retrieveMemberUrl: "../controller/controller.php?action=retrieveMemberById"
        },
		_addExoWidgetEventHandlers: function(){
			var that = this;
			var options = that.options;
			//respod to edit event fired on table row click
			$(document).bind("editMember", function(e, id){
				that._retrieveMember(id);
			});
		},
        _create: function(){
			var that = this;
			//$.tf.baseForm.prototype._create.call(this);
			that._super("_create");
			that._makeElementObjectsFromTemplate();
			that._addInnerWidgetEventHandlers();
			that._addExoWidgetEventHandlers();
		},
		_insertMemberJsonIntoForm: function(){
			var that = this;
			var options = that.options;
			data = options._memberJson;
			options._inputEmail.val(data.email) ;
			options._inputFName.val(data.fName);
			options._inputLName.val(data.lName);
		},
		_retrieveMember: function(id){
			var that = this;
			var options = that.options;
			var data = "";
			data += "id=" + id;
			that._ajaxCall(that._verifyRetrieveMember, data, options._retrieveMemberUrl)
		},
		_submitMemberForm: function(){
			var that = this;
			var options = that.options;
			if(that._validateAllFormFields()){
				var data = "";
				data += "fName=" + options._inputFName.val();
				data += "&id=" + options._memberJson.id;
				data += "&lName=" + options._inputLName.val();
				data += "&email=" + options._inputEmail.val();
				that._ajaxCall(that._verifyMemberEdit, data, options._editMemberUrl);
			}
		},
		_verifyMemberEdit: function(data, that){
			var options = that.options;
			data = $.parseJSON(data);
			if(data.success){
				$(document).trigger("memberChanged");
				options._blockMain.slideUp(1000);//hide inputs
				options._blockSuccess.slideDown( //show the success div with callback to close the form and reset
					1000, 
					function(){
						setTimeout(
							function(){
								that._closeForm();
								options._blockMain.css("display", "block");
								options._blockSuccess.css("display", "none");
							},
							1500
						);
					}
				);
			}
		},
		_verifyRetrieveMember: function(data, that){
			var options = that.options;
			data = $.parseJSON(data);
			options._memberJson = data.member;
			that._insertMemberJsonIntoForm();
			if(!options._isDisplayed){
				that._displayForm();
				options._formContainer.css("left", $("#pageContent").offset()["left"] + 10 + "px");
				options._formContainer.css("top", $("#pageContent").offset()["top"] + 53 + "px");
			}
		}
    });
})(jQuery);
(function($){
    $.widget("tf.lolForm", $.tf.memberForm,{
        options: {
			openButtonSel: undefined,
            htmlTemplateSel: ".tf_lolForm",
			//element objects
			_btnTeamQ: undefined,
			_btnWinQ: undefined,
			_inputEmail: undefined,
			_inputName: undefined,
			_inputSName: undefined,
			_inputTName: undefined,
			_inputTeamPw: undefined,
			_inputWins: undefined,
			_selectTeam: undefined,
			//element selectors
			_btnTeamQSel: ".tf_memberForm_teamQ",
			_btnWinQSel: ".tf_memberForm_winQ",
			_inputEmailSel: ".tf_memberForm_email",
			_inputNameSel: ".tf_memberForm_name",
			_inputSNameSel: ".tf_memberForm_sName",
			_inputTNameSel: ".tf_memberForm_tName",
			_inputTeamPwSel: ".tf_memberForm_tPw",
			_inputWinsSel: ".tf_memberForm_wins",
			_selectTeamSel: ".tf_memberForm_teamSelect",
			//url's
			_lolSignupUrl:  "../controller/controller.php?action=lolSignup",
			_retrieveTeamsUrl:  "../controller/controller.php?action=retrieveLolTeamNames"
        },
		_addExoWidgetEventHandlers: function(){
			var that = this;
			var options = that.options;
			//open button
			$(options.openButtonSel).click(function(){
				that._displayForm();
				options._formContainer.css("left", $("#pageContent").offset()["left"] + 10 + "px");
				options._formContainer.css("top", $("#pageContent").offset()["top"] + 53 + "px");
			});
		},
		_addInnerWidgetEventHandlers: function(){
			var that = this;
			var options = that.options;
			//submit button
			options._btnSubmit.click(function(){
				that._submitMemberForm();
			});
			//close button
			options._btnCancel.click(function(){
				that._closeForm();
			});
			//enter key
			$(document).keyup(function(e){
				if(options._isDisplayed && options._isSelected)
					if(e.keyCode == "13")
						options._btnSubmit.click();
			});
			//team question button
			options._btnTeamQ.click(function(){
				alert("Enter your team name.\n" + 
					"This does not need to be an official ranked team.\n" +
					"To join an existing team, select it from the dropdown.\n" + 
					"and enter the password.\n\n" +
					"Note: The team password is set by the first person to register\n" +
					"as a member of that team."
				);
			});
			//wins question button
			options._btnWinQ.click(function(){
				alert("Wins will be used to create balanced teams for those who\n" + 
					"are entering the competition without a full five-person lineup.\n\n" +
					"An approximation of your number of wins will be fine."
				);
			});
			//change team in select
			options._selectTeam.change(function(){
				options._inputTName.val(options._selectTeam.val());
				options._selectTeam.val(0);
			});
			//validation
			that._keydownTimeout(
				options._inputEmail, 
				function(){
					that._validateEmail();
				},
				1000,
				false
			);
			that._keydownTimeout(
				options._inputName, 
				function(){
					that._validateName();
				},
				1000,
				false
			);
			that._keydownTimeout(
				options._inputSName, 
				function(){
					that._validateSName();
				},
				1000,
				false
			);
		},
        _create: function(){
			var that = this;
			//$.tf.baseForm.prototype._create.call(this);
			that._super("_create");
			that._makeElementObjectsFromTemplate();
			that._addInnerWidgetEventHandlers();
			that._addExoWidgetEventHandlers();
			that._retrieveTeamNames();
		},
		_makeElementObjectsFromTemplate: function(){
			var that = this;
			var options = that.options;
			options._blockMain = options._formContainer.find(options._blockMainSel);
			options._blockSuccess = options._formContainer.find(options._blockMemberAddedSel);
			options._btnCancel = options._formContainer.find(options._cancelBtnSel);
			options._btnSubmit = options._formContainer.find(options._submitBtnSel);
			options._btnTeamQ = options._formContainer.find(options._btnTeamQSel);
			options._btnWinQ = options._formContainer.find(options._btnWinQSel);
			options._inputEmail = options._formContainer.find(options._inputEmailSel);
			options._inputName = options._formContainer.find(options._inputNameSel);
			options._inputSName = options._formContainer.find(options._inputSNameSel);
			options._inputTName = options._formContainer.find(options._inputTNameSel);
			options._inputTeamPw = options._formContainer.find(options._inputTeamPwSel);
			options._selectTeam = options._formContainer.find(options._selectTeamSel);
			options._inputWins = options._formContainer.find(options._inputWinsSel);
		},
		_retrieveTeamNames: function(){
			var that = this;
			var options = that.options;
			that._ajaxCall(that._verifyRetrieveTeamNames, "", options._retrieveTeamsUrl);
		},
		_submitMemberForm: function(){
			var that = this;
			var options = that.options;
			if(that._validateAllFormFields()){
				var data = "";
				data += "email=" + options._inputEmail.val();
				data += "&name=" + options._inputName.val();
				data += "&sName=" + options._inputSName.val();
				data += "&tId=" + options._selectTeam.val();
				data += "&tName=" + options._inputTName.val();
				data += "&tPw=" + options._inputTeamPw.val();
				data += "&wins=" + options._inputWins.val();
				that._ajaxCall(that._verifyLolSignup, data, options._lolSignupUrl);
			}
		},
		_validateAllFormFields: function(){
			var that = this;
			return(
				that._validateName() &
				that._validateEmail() &
				that._validateSName()
			);
		},
		_validateEmail: function(){
			var that = this;
			var options = that.options;
			if(!that._isValidEmail(options._inputEmail.val())){
				options._inputEmail.css("border", "1px solid red");
				return false;
			}
			else{
				options._inputEmail.css("border", "1px solid black");
				return true;
			}
		},
		_validateName: function(){
			var that = this;
			var options = that.options;
			if(that._isEmptyString(options._inputName.val())){
				options._inputName.css("border", "1px solid red");
				return false;
			}
			else{
				options._inputName.css("border", "1px solid black");
				return true;
			}
		},
		_validateSName: function(){
			var that = this;
			var options = that.options;
			if(that._isEmptyString(options._inputSName.val())){
				options._inputSName.css("border", "1px solid red");
				return false;
			}
			else{
				options._inputSName.css("border", "1px solid black");
				return true;
			}
		},
		_verifyLolSignup: function(data, that){
			var options = that.options;
			data = $.parseJSON(data);
			if(data.status == "badPw")
				alert("The password for the selected team is incorrect.")
			else{
				if(data.success){
					options._blockMain.slideUp(1000);//hide inputs
					options._blockSuccess.slideDown( //show the success div with callback to close the form and reset
						1000, 
						function(){
							setTimeout(
								function(){
									that._closeForm();
									options._blockMain.css("display", "block");
									options._blockSuccess.css("display", "none");
								},
								1500
							);
						}
					);
				}
			}
		},
		_verifyRetrieveTeamNames: function(data, that){
			var options = that.options;
			data = $.parseJSON(data);
			var teams = data.teamNameAr
				options._selectTeam.append("<option value=''></option>");
			for(var i = 0; i < teams.length; i++){
				options._selectTeam.append("<option value='" + teams[i] + "'>" + teams[i] + "</option>");
			}
		}
    });
})(jQuery);
(function($){
    $.widget("tf.lolTeamManager", $.tf.codeModule, {
        options: {
			_lolTeamInfo: undefined,
			//element selectors
			_teamTbodyeSel: ".tf_teamTable_tbody",
            //url's
			_retrieveLolTeamInfoUrl: "../controller/controller.php?action=retrieveLolTeamInfo"
        },
        _create: function(){
            var that = this;
			var options = that.options;
			that._retrieveLolTeamInfo().done(function(){
				that._makeTeamTableFromJson();
			});
        },
		_makeTeamTableFromJson: function(){
		//klooge code - don't read
			var that = this;
			var options = that.options;
			var info = options._lolTeamInfo;
			var row = $(options._teamTbodyeSel).find("tr").detach();
			for(var i = 0; i < info.length; i++){
				row.find(".pName").html("");	// <----| resetting the contents of the member cells
				row.find(".tSName").html("");	//	    | so the team names are alone on a row
				row.find(".wins").html("");		//      |
				row.find(".pEmail").html("");	// <----|
				row.find(".teamName").html(info[i].name);
				if(info[i].name == "No Team")
					row.find(".teamName").css("background-color", "purple");
				else{
					if(info[i].players.length <= 4)
						row.find(".teamName").css("background-color", "yellow");
					if(info[i].players.length == 5)
						row.find(".teamName").css("background-color", "green");
					if(info[i].players.length > 5)
						row.find(".teamName").css("background-color", "red");
				}
				$(options._teamTbodyeSel).append(row.clone());
				row.find(".teamName").css("background-color", "");//apend team name cell color
				for(var j = 0; j < info[i].players.length; j++){
					row.find(".teamName").html(j + 1);
					row.find(".pName").html(info[i].players[j].name);
					row.find(".tSName").html(info[i].players[j].sName);
					row.find(".wins").html(info[i].players[j].wins);
					row.find(".pEmail").html(info[i].players[j].email);
					$(options._teamTbodyeSel).append(row.clone());
				}
			}
		},
		_retrieveLolTeamInfo: function(){
			var that = this;
			var options = that.options;
			var d = new $.Deferred();
			that._ajaxCall(that._verifyRetrieveLolTeamInfo, "", options._retrieveLolTeamInfoUrl).done(function(){
				d.resolve();
			});
			return d.promise();
		},
		_verifyRetrieveLolTeamInfo: function(data, that){
			var options = that.options;
			data = $.parseJSON(data);
			options._lolTeamInfo = data.teamAr;
		}
    });
})(jQuery);
(function($){
    $.widget("tf.memberManager", $.tf.codeModule, {
        options: {
            _members: undefined,
			//element objects
			_rowMemberRow: undefined,
			_tbodyMemberTbody: undefined,
			//element selectors
			_tdLNameSel: ".tf_memberTable_lName",
			_tdFNameSel: ".tf_memberTable_fName",
			//_tdEmailSel: ".tf_memberTable_email",
			_tdSummonerSel: ".tf_memberTable_summoner",
			_memberTableSel: ".memberTable",
			_overlaySel: ".tf_memberTable_overlay",
			_rowMemberRowSel: ".tf_memberTable_memberRow",
			_tbodyMemberTbodySel: ".tf_memberTable_tbody",
			//url's
			_retrieveMembersUrl: "../controller/controller.php?action=retrieveAllMembers"
        },
		_addExoWidgetEventHandlers: function(){
			var that = this;
			$(document).bind("memberChanged", function(){
				that._displayMemberTable();
			});
		},
		_addInnerWidgetEventHandlers: function(){
			var that = this;
			var options = that.options;
			//add click handler to row template
			/*options._rowMemberRow.click(function(e){
				$(document).trigger("editMember", e.delegateTarget.id);
			});*/
			options._rowMemberRow.hover(
				function(){
					options.tempRowBgColor = $(this).css("background-color");
					options.tempOverlayBgImage = $(this).find(options._overlaySel).css("background-image");
					$(this).find(options._overlaySel).css("background-image", "url('../images/gradAAAAFF.png')");
					$(this).css("background-color", "#aaaaff");
				},
				function(){
					$(this).find(options._overlaySel).show();
					$(this).css("background-color", options.tempRowBgColor);
					$(this).find(options._overlaySel).css("background-image", options.tempOverlayBgImage);
				}
			);
		},
		_clearMemberTbody: function(){
			var that = this;
			var options = that.options;
			options._tbodyMemberTbody.html("");
		},
        _create: function(){
            var that = this;
			that._makeElementObjectsFromTemplate();
			that._addExoWidgetEventHandlers();
			that._addInnerWidgetEventHandlers();
			that._displayMemberTable();
        },
		_displayMemberTable: function(){
            var that = this;
			that._retrieveAllMembers().done(function(){
				that._clearMemberTbody();
				that._makeMemberTable();
				that._showTable();
			});
		},
		_makeElementObjectsFromTemplate: function(){
			var that = this;
			var options = that.options;
			options._tbodyMemberTbody = $(options._tbodyMemberTbodySel);
			options._rowMemberRow = $(options._rowMemberRowSel).detach();
		},
		_makeMemberTable: function(){
			var that = this;
			var options = that.options;
			var members = options._members;
			for(var i = 0; i < members.length; i++){
				var rowClone = options._rowMemberRow.clone(true);
				if(i % 2 != 0){
					rowClone.css("background-color", "#bbbbbb");
					rowClone.find(options._overlaySel).css("background-image", "url('../images/gradBBBBBB.png')");
				}
				else{
					rowClone.css("background-color", "#dddddd");
					rowClone.find(options._overlaySel).css("background-image", "url('../images/gradDDDDDD.png')");
				}
				rowClone.find(options._tdLNameSel).html(members[i].lName);
				rowClone.find(options._tdFNameSel).html(members[i].fName);
				//rowClone.find(options._tdEmailSel).html(members[i].email);
				rowClone.find(options._tdSummonerSel).html(members[i].summoner);
				rowClone.attr("id", members[i].id);
				options._tbodyMemberTbody.append(rowClone);
			}
		},
		_retrieveAllMembers: function(){
			var that = this; 
			var options = that.options;
			var d = new $.Deferred();
			that._ajaxCall(that._verifyRetrieveAllMembers, "", options._retrieveMembersUrl).done(function(){
				return d.resolve();
			});
			return d.promise();
		},
		_showTable: function(){
			var that = this;
			var options = that.options;
			$(options._memberTableSel).css("visibility", "visible");
		},
		_verifyRetrieveAllMembers: function(data, that){
			var options = that.options;
			data = $.parseJSON(data);
			options._members = data.memberAr;
		}
    });
})(jQuery);