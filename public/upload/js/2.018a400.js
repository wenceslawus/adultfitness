(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[2],{"0bwl":function(t,e,i){},"0kiK":function(t,e,i){"use strict";var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"video-list"},[t.title?i("a-block-divider",{attrs:{customIcon:t.customIcon,icon:t.icon,title:t.title}}):t._e(),i("div",{staticClass:"video-container row gutter-sm",class:{nospacing:t.compact}},t._l(t.itemsPaged,function(e,n){return i("div",{key:n,staticClass:"col-xs-12 col-sm-6"},[i("a-video-player",{attrs:{video:e,canRemove:t.canRemove},on:{remove:function(i){t.$emit("remove",e.id)}}})],1)})),t.linkToAll&&!t.needpaginator?i("q-btn",{staticClass:"next",attrs:{dense:"",size:"lg",color:"primary",label:t.$t("general.more"),"text-color":"black",to:t.linkToAll}}):t._e(),t.needpaginator?i("q-pagination",{staticClass:"q-mb-lg flex-center",attrs:{max:t.maxPages,"max-pages":6},model:{value:t.page,callback:function(e){t.page=e},expression:"page"}}):t._e()],1)},o=[];n._withStripped=!0;var a=i("jnYV"),r=i("VuJm"),s={components:{"a-video-player":a["a"],"a-block-divider":r["a"]},props:{items:{},title:{},icon:{},customIcon:{},linkToAll:{},canRemove:{},compact:{}},data:function(){return{page:1}},computed:{needpaginator:function(){return this.items.length>16},maxPages:function(){return Math.ceil(this.items.length/16)},itemsPaged:function(){var t=16*(this.page-1);return this.items.slice(t,t+16)}}},c=s,l=(i("FGg/"),i("KHd+")),u=Object(l["a"])(c,n,o,!1,null,null,null);u.options.__file="group.vue";e["a"]=u.exports},"7ggI":function(t,e,i){"use strict";var n=i("vXam"),o=i.n(n);o.a},"FGg/":function(t,e,i){"use strict";var n=i("0bwl"),o=i.n(n);o.a},VuJm:function(t,e,i){"use strict";var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"block-divider"},[t.customIcon?i("a-custom-icon",{staticClass:"q-mx-sm",attrs:{icon:t.customIcon,color:"#ff5600",size:"25px"}}):i("q-icon",{staticClass:"q-mx-sm",attrs:{name:t.icon,color:"primary",size:"25px"}}),i("h3",{domProps:{textContent:t._s(t.title)}}),t.description?i("p",{domProps:{textContent:t._s(t.description)}}):t._e()],1)},o=[];n._withStripped=!0;var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"custom-icon"},[i("svg",{staticStyle:{"enable-background":"new 0 0 334.5 334.5"},style:{fill:t.color,height:t.size,width:t.size},attrs:{version:"1.1",id:"Capa_1",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",x:"0px",y:"0px",viewBox:"0 0 334.5 334.5","xml:space":"preserve"}},[i("path",{attrs:{d:"M332.797,13.699c-1.489-1.306-3.608-1.609-5.404-0.776L2.893,163.695c-1.747,0.812-2.872,2.555-2.893,4.481\n        s1.067,3.693,2.797,4.542l91.833,45.068c1.684,0.827,3.692,0.64,5.196-0.484l89.287-66.734l-70.094,72.1\n        c-1,1.029-1.51,2.438-1.4,3.868l6.979,90.889c0.155,2.014,1.505,3.736,3.424,4.367c0.513,0.168,1.04,0.25,1.561,0.25\n        c1.429,0,2.819-0.613,3.786-1.733l48.742-56.482l60.255,28.79c1.308,0.625,2.822,0.651,4.151,0.073\n        c1.329-0.579,2.341-1.705,2.775-3.087L334.27,18.956C334.864,17.066,334.285,15.005,332.797,13.699z"}})])])},r=[];a._withStripped=!0;var s={props:{icon:{},color:{},size:{}}},c=s,l=i("KHd+"),u=Object(l["a"])(c,a,r,!1,null,null,null);u.options.__file="customIcon.vue";var p=u.exports,d={components:{"a-custom-icon":p},props:{title:{},customIcon:{},icon:{},description:{}}},v=d,m=(i("a+BI"),Object(l["a"])(v,n,o,!1,null,null,null));m.options.__file="title.vue";e["a"]=m.exports},"a+BI":function(t,e,i){"use strict";var n=i("eHz7"),o=i.n(n);o.a},aBTK:function(t,e,i){"use strict";i.r(e);var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("q-page",{staticClass:"container"},[i("q-card",{staticClass:"profile-sub-card",staticStyle:{margin:"auto","background-color":"#141414"}},[i("q-card-main",[i("div",{staticClass:"row gutter-sm profile-card"},t._l(t.trainerData,function(e,n){return i("div",{key:n,staticClass:"col-12"},[i("h5",{domProps:{textContent:t._s(t.$t("profile."+e))}}),i("p",[t._v(t._s(t.userData.trainer[e]))])])}))])],1)],1)},o=[];n._withStripped=!0;var a=i("MVZn"),r=i.n(a),s=(i("0kiK"),i("L2JU")),c={computed:r()({},Object(s["c"])({avatar:"auth/avatar",me:"auth/me",userData:"training/trainer"}),{trainerData:function(){var t=this;return this.userData&&this.userData.trainer?["description","specs","exp","hobby"].filter(function(e){return t.userData.trainer&&t.userData.trainer[e]}):[]}}),methods:r()({},Object(s["b"])({getTrainer:"training/getTrainer"})),data:function(){return{}},mounted:function(){this.$router.currentRoute}},l=c,u=i("KHd+"),p=Object(u["a"])(l,n,o,!1,null,null,null);p.options.__file="profile.vue";e["default"]=p.exports},eHz7:function(t,e,i){},jnYV:function(t,e,i){"use strict";var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("q-card",{staticClass:"player-preview relative-position"},[t.canRemove?i("q-btn",{staticClass:"absolute-top-left",staticStyle:{"z-index":"99",top:"5px",left:"5px"},attrs:{icon:"delete",color:"red",round:""},on:{click:function(e){t.$emit("remove")}}}):t._e(),i("q-card-media",{style:{backgroundImage:"url("+t.video.link_preview+")"},nativeOn:{click:function(e){t.$router.push({name:"play",params:{id:t.video.id}})}}},[i("img",{staticClass:"vi",attrs:{src:t.video.link_preview}}),i("div",{staticClass:"shadow"}),i("div",{staticClass:"overlay"}),i("div",{staticClass:"overlay transparent"},[i("muscule-map",{staticStyle:{width:"auto",height:"82%",padding:"0 22px"},attrs:{front:t.isfront,groups:t.video.groups}}),i("span",[t._v(t._s(t.baseGroup))])],1),i("div",{staticClass:"duration",domProps:{textContent:t._s(t.miniOverlay(t.video.duration))}})]),i("q-card-title",[i("span",{staticClass:"text-overflow"},[t._v(t._s(t.video.title))]),i("div",{staticClass:"video-desc"},[i("div",[i("q-icon",{attrs:{name:"visibility"}}),i("span",{domProps:{textContent:t._s(t.$tc("video.view",t.video.views,{n:t.video.views}))}})],1),i("span",{staticClass:"gray",domProps:{textContent:t._s(t.video.created_at)}})])]),t.video.groupName?i("q-card-actions",[i("q-btn",{attrs:{flat:"",color:"primary",label:t.video.groupName},on:{click:function(e){t.goTo(t.video.groupId)}}})],1):t._e()],1)},o=[];n._withStripped=!0;i("Vd3H"),i("rGqo");var a=i("MVZn"),r=i.n(a),s=(i("lqHd"),i("L2JU")),c=i("2iEn"),l={2:-1,3:1,4:1,5:-1,6:-1,7:-1,8:0,9:1,10:-1,11:1,12:-1,13:1,14:1,15:-1},u={props:{video:{},canRemove:{}},components:{"muscule-map":c["a"]},computed:r()({},Object(s["c"])({allGroups:"video/groups"}),{musculeDirection:function(){var t=0;return this.video.groups&&this.video.groups.forEach(function(e){t+=(4-e.weight)*l[e.id]*2}),t},isfront:function(){return this.musculeDirection<0},baseGroup:function(){var t=this;if(this.video.groups){var e=this.video.groups.filter(function(e){return t.isfront?l[e.id]<0:l[e.id]>=0}).sort(function(t,e){return e.weight-t.weight}).pop();if(e){var i=this.allGroups.filter(function(t){return t.id==e.id});return i[0]?i[0].title:"No group"}}return"No group"}}),mounted:function(){},methods:{goTo:function(t){this.$router.push("/group/".concat(t))},miniOverlay:function(t){var e=t%60,i=(t-e)/60;return i<10&&(i="0"+i),e<10&&(e="0"+e),"HD ".concat(i,":").concat(e)}}},p=u,d=(i("7ggI"),i("KHd+")),v=Object(d["a"])(p,n,o,!1,null,null,null);v.options.__file="preview.vue";e["a"]=v.exports},lqHd:function(t,e,i){"use strict";var n=i("pg2m");e["a"]=function(t,e){if(n["a"].is.cordova&&navigator&&navigator.app)return navigator.app.loadUrl(t,{openExternal:!0});var i=window.open(t,"_blank");if(i)return i.focus(),i;e()}},vXam:function(t,e,i){}}]);