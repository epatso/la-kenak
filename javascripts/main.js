/**
 * jQuery-ui-tab-utils.js - Utilities to help with the jquery UI tab control
 * Date: 08/20/2013
 * @author Kyle White - kyle@kmwTech.com
 * @version 0.1
 * Built for and tested with jQuery UI 1.9.2
 * License: Use at your own risk and feel free to use this however you want.
 *
 * USAGE: 
 * $('MyTabSelector').disableTab(0);        // Disables the first tab
 * $('MyTabSelector').disableTab(1, true);  // Disables & hides the second tab
 * $('MyTabSelector').enableTab(1);         // Enables & shows the second tab
 * 
 * For the hide option to work, you need to define the following css
 *   li.ui-state-default.ui-state-hidden[role=tab]:not(.ui-tabs-active) {
 *     display: none;
 *   }
 */
(function ($) {
    $.fn.disableTab = function (tabIndex, hide) {
 
        // Get the array of disabled tabs, if any
        var disabledTabs = this.tabs("option", "disabled");
 
        if ($.isArray(disabledTabs)) {
            var pos = $.inArray(tabIndex, disabledTabs);
 
            if (pos < 0) {
                disabledTabs.push(tabIndex);
            }
        }
        else {
            disabledTabs = [tabIndex];
        }
 
        this.tabs("option", "disabled", disabledTabs);
 
        if (hide === true) {
            $(this).find('li:eq(' + tabIndex + ')').addClass('ui-state-hidden');
        }
 
        // Enable chaining
        return this;
    };
 
    $.fn.enableTab = function (tabIndex) {
 

        // Remove the ui-state-hidden class if it exists
        $(this).find('li:eq(' + tabIndex + ')').removeClass('ui-state-hidden');
 
        // Use the built-in enable function
        this.tabs("enable", tabIndex);
 
        // Enable chaining
        return this;


    };
 
})(jQuery);

$(function(){
	
	// Accordion
	$("#accordion").accordion({ header: "h3" });

	// Tabs
	$('#tabs').tabs();
	$('#tabs-inside').tabs();
	$( "#tabs-inside" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs-inside li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	
	//menu
	$( "#menu" ).menu({
		position: {at: "left bottom"}
	});

	// Dialog
	$('#dialog-ktimatologio').dialog({
		autoOpen: false,
		width: 800,
		height: 600,
		buttons: {
			"ΟΚ": function() {
				$(this).dialog("close");
			},
			"Άκυρο": function() {
				$(this).dialog("close");
			}
		}
	});

	// Dialog Link
	$('#dialog-ktimatologio-link').click(function(){
		$('#dialog-ktimatologio').dialog('open');
		return false;
	});

	//Timepicker
	$('#ta_datepicker').datepicker({
		inline: true
	});
	$('#ie_datepicker').datepicker({
		inline: true
	});
	
	$('#ta_timestart').timepicker({
		hourGrid: 4,
		minuteGrid: 10,
		timeFormat: 'HH:mm'
	});
	$('#ta_timeend').timepicker({
		hourGrid: 4,
		minuteGrid: 10,
		timeFormat: 'HH:mm'
	});
	$('#ie_timestart').timepicker({
		hourGrid: 4,
		minuteGrid: 10,
		timeFormat: 'HH:mm'
	});
	$('#ie_timeend').timepicker({
		hourGrid: 4,
		minuteGrid: 10,
		timeFormat: 'HH:mm'
	});
	$("input.timepicker").timepicker({
		hourGrid: 4,
		minuteGrid: 10,
		timeFormat: 'HH:mm'
	}); 

	//tooltips
	$('#tb_meletes_aa').tooltip();
	$('#tb_meletes_onoma').tooltip();
	$('#tb_meletes_address').tooltip();
	$('#tb_meletes_xrisi').tooltip();
	$('#tb_meletes_type').tooltip();
	$('#tb_meletes_epiloges').tooltip();
	$('#tb_meletes_teyxos').tooltip();
	
	$('.tooltipbs').tooltip({
		track: true
	});

	// Slider
	$('#slider').slider({
		range: true,
		values: [17, 67]
	});

	// Progressbar
	$("#progressbar").progressbar({
		value: 20
	});

	//hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
	$(".btmiddle").click(function() {
		if ($(".btmiddle").hasClass("bt")) {
			$(".btmiddle").removeClass("bt");
			$(".btmiddle").addClass("clicked");
			$("#menu2").hide();
			$("#menu1").show();
		} else {
			$(".btmiddle").removeClass("clicked");
			$(".btmiddle").addClass("bt");
			$("#menu1").hide();
		}
	});
	$(".btright").click(function() {
		if ($(".btright").hasClass("bt")) {
			$(".btright").removeClass("bt");
			$(".btright").addClass("clicked");
			$("#menu1").hide();
			$("#menu2").show();
		} else {
			$(".btright").removeClass("clicked");
			$(".btright").addClass("bt");
			$("#menu2").hide();
		}
	});

});

$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'inline';     
});