(function( $ ) {
	'use strict';
	
	const { __ } = wp.i18n;
	
	let originalInterval = 120;
	
	const generateDelete = (slug,text) => {
		return ` <span class="dashicons dashicons-trash aip-rem" data-text="${text}" data-list="${slug}"></span>`;
	};
	
	const aip_loading = () => {
		let str = "";
		str = '<div class="load-3">';
		str += '<div class="aip-line"></div>';
		str += '<div class="aip-line"></div>';
		str += '<div class="aip-line"></div>';
		str += '</div>';
		return str;
	};
	
	const updateInterval = (formid) => {
		const valid = [
			"aip-gen-ideas-form",
			"aip-gen-articles-form",
			"aip-gen-images-form"
		];
		if (!valid.includes(formid)) return;
		originalInterval = wp.heartbeat.interval;
		wp.heartbeat.interval = 30;
	};
	
	const aip_process_form = (e,formid) => {
			e.preventDefault();
			const buttonId = e.originalEvent.submitter.id;
			const button = $(`#${buttonId}`);
			const buttonText = button.html();
			button.html(aip_loading());
			button.prop("disabled",true);
			const confirmation = parseInt(button.attr("data-confirm"));
			let conf = true;
			
			if (confirmation === 1) {
				conf = confirm(__("Are you sure you want to submit this form?","post-perfect-ai"));
			}
			if (!conf) { 
				button.html(buttonText);
				button.prop("disabled",false);
			} else {
				updateInterval(formid);
				document.getElementById(formid).submit();
			}	
	};
	
	const ppaiInsertMessage = (message) => {
		const html = `<div class="notice notice-info is-dismissible"><p>${message}</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">${__("Dismiss this notice.","post-perfect-ai")}</span></button></div>`;
		const fh1 = $('h1:first-of-type');
		if (fh1.length > 0) {
			fh1.after(html);	
		} else {
			$('.wrap').prepend(html);
		}
	};
	
	$(document).on("heartbeat-tick",()=>{
		$.post(ajaxurl,{action:'ppai_heartbeat_received'},function(response) {
			const resp = JSON.parse(response);
			if (resp.message === "") return;
			ppaiInsertMessage(resp.message);
			wp.heartbeat.interval = originalInterval;
		});
	});
	
	$(document).ready(()=>{
		
		$('.wrap').on("submit","#aip-gen-ideas-form", function(e) {
			aip_process_form(e,$(this).attr("id"));
		});
		
		$('.wrap').on("submit","#aip-gen-articles-form", function(e) {
			aip_process_form(e,$(this).attr("id"));
		});
		
		$('.wrap').on("submit","#aip-gen-images-form", function(e) {
			aip_process_form(e,$(this).attr("id"));
		});
		
		$('.wrap').on("submit","#update-settings-form", function(e) {
			aip_process_form(e,$(this).attr("id"));			
		});
		
		$('.wrap').on("submit","#ppai-help-form",function(e) {
			aip_process_form(e,$(this).attr("id"));
		});
		
		$('.wrap').on("submit","#register-plugin-form",function(e) {
			aip_process_form(e,$(this).attr("id"));
		});
		
		$('.wrap').on("keypress",".aip-focus-enter",function(e) {
			
			const keycode = e.keyCode ? e.keyCode : e.which;
			if (keycode !== 13) return;
			e.preventDefault();
			const bid = $(this).attr('data-buttonid');
			$(`.aip-add-button[id="${bid}"]`).trigger("click");
		});
		
		$('.wrap').on("click",".aip-add-button",function(e) {
			const clicked = $(this);
			const slug = clicked.attr("data-slug");
			const genre = $(`#${slug}`);
			const output = $(`#${slug}_output`);
			const hidden = $(`#${slug}_hidden`);
			e.preventDefault();
			let entered = genre.val();
			if (entered === "") return;
			let earr = [];
			let elist = "";
			let hasList = false;
			if (entered.indexOf(",") > -1) {
				hasList = true;
				earr = entered.split(",");
				earr.forEach(ele=>{
					elist += `${ele}${generateDelete(slug,ele)}<br>`;
				});
			}
			genre.val("");
			const list = output.html();
			const enew = hasList ? elist : `${entered}${generateDelete(slug,entered)}<br>`;
			if (list === "None") {
				output.html(enew);
			} else {
				output.html(list+enew);
			}
			const val = hidden.val();
			let varr;
			if (val === "") {
				varr = [];
			} else {
				varr = JSON.parse(val);
			}
			if (hasList) {
				varr.push(...earr);
			} else {
				varr.push(entered);
			}
			const newval = JSON.stringify(varr);
			hidden.val(newval);
			
		});
		
		$('.wrap').on("click",".aip-rem",function() {
			const ele = $(this);
			const slug = ele.attr("data-list");
			const text = ele.attr("data-text");
			const hidden = $(`#${slug}_hidden`);
			const val = hidden.val();
			if (val === "") return;
			const varr = JSON.parse(val);
			const idx = varr.findIndex(ele=>ele === text);
			varr.splice(idx,1);
			let txt = "";
			varr.forEach(ele=>{
				txt += `${ele}${generateDelete(slug,ele)}<br>`;
			});
			$(`#${slug}_output`).html(txt);
			hidden.val(JSON.stringify(varr));
		});
		
		$('.wrap').on("change","#aip_image_style",function() {
			const ele = $(this);
			const cv = ele.val();
			if (cv === "0" || cv === "1" || cv === "13") {
				$('#aip_image_camera').prop("disabled",false);
				$('#aip_image_lens').prop("disabled",false);
			} else {
				$('#aip_image_camera').prop("disabled",true);
				$('#aip_image_lens').prop("disabled",true);
			}
		});
		
		$('.wrap').on("change","input[name=aip_image_enhance]",function() {
			const basic = $('#aip_image_basic');
			const adv = $('#aip_image_advanced');
			const ele = $(this);
			if (ele.prop("checked")) {
				basic.slideUp();
				adv.slideDown();
			} else {
				adv.slideUp();
				basic.slideDown();
			}
		});
	});

})( jQuery );
