(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[6],{"0pQ5":function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(){for(var e=arguments.length,t=new Array(e),r=0;r<e;r++)t[r]=arguments[r];return(0,n.withParams)({type:"or"},function(){for(var e=this,r=arguments.length,n=new Array(r),i=0;i<r;i++)n[i]=arguments[i];return t.length>0&&t.reduce(function(t,r){return t||r.apply(e,n)},!1)})};t.default=i},"1PTn":function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=(0,n.withParams)({type:"required"},n.req);t.default=i},"5lKX":function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(e){return(0,n.withParams)({type:"requiredUnless",prop:e},function(t,r){return!!(0,n.ref)(e,this,r)||(0,n.req)(t)})};t.default=i},"62b2":function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(e){return(0,n.withParams)({type:"minValue",min:e},function(t){return!(0,n.req)(t)||(!/\s/.test(t)||t instanceof Date)&&+t>=+e})};t.default=i},"7BF0":function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(e,t){return(0,n.withParams)({type:"between",min:e,max:t},function(r){return!(0,n.req)(r)||(!/\s/.test(r)||r instanceof Date)&&+e<=+r&&+t>=+r})};t.default=i},EzHr:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=(0,n.regex)("integer",/^-?[0-9]*$/);t.default=i},KhKh:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(e){return(0,n.withParams)({type:"maxLength",max:e},function(t){return!(0,n.req)(t)||(0,n.len)(t)<=e})};t.default=i},M2AK:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(){for(var e=arguments.length,t=new Array(e),r=0;r<e;r++)t[r]=arguments[r];return(0,n.withParams)({type:"and"},function(){for(var e=this,r=arguments.length,n=new Array(r),i=0;i<r;i++)n[i]=arguments[i];return t.length>0&&t.reduce(function(t,r){return t&&r.apply(e,n)},!0)})};t.default=i},OlTG:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=(0,n.regex)("alphaNum",/^[a-zA-Z0-9]*$/);t.default=i},RbiO:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=(0,n.regex)("numeric",/^[0-9]*$/);t.default=i},RryX:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(e){return(0,n.withParams)({type:"maxValue",max:e},function(t){return!(0,n.req)(t)||(!/\s/.test(t)||t instanceof Date)&&+t<=+e})};t.default=i},XXVU:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=/(^$|^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$)/,a=(0,n.regex)("email",i);t.default=a},XbO3:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(e){return(0,n.withParams)({type:"minLength",min:e},function(t){return!(0,n.req)(t)||(0,n.len)(t)>=e})};t.default=i},YjXl:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=(0,n.regex)("alpha",/^[a-zA-Z]*$/);t.default=i},ZBfT:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(e){return(0,n.withParams)({type:"not"},function(t,r){return!(0,n.req)(t)||!e.call(this,t,r)})};t.default=i},bkty:function(e,t,r){},dy1E:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/i,a=(0,n.regex)("url",i);t.default=a},eO9T:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),Object.defineProperty(t,"withParams",{enumerable:!0,get:function(){return n.default}}),t.regex=t.ref=t.len=t.req=void 0;var n=i(r("h1BH"));function i(e){return e&&e.__esModule?e:{default:e}}function a(e){return a="function"===typeof Symbol&&"symbol"===typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"===typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},a(e)}var o=function(e){if(Array.isArray(e))return!!e.length;if(void 0===e||null===e)return!1;if(!1===e)return!0;if(e instanceof Date)return!isNaN(e.getTime());if("object"===a(e)){for(var t in e)return!0;return!1}return!!String(e).length};t.req=o;var u=function(e){return Array.isArray(e)?e.length:"object"===a(e)?Object.keys(e).length:String(e).length};t.len=u;var s=function(e,t,r){return"function"===typeof e?e.call(t,r):r[e]};t.ref=s;var l=function(e,t){return(0,n.default)({type:e},function(e){return!o(e)||t.test(e)})};t.regex=l},h1BH:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n="web"===Object({NODE_ENV:"production",CLIENT:!0,SERVER:!1,DEV:!1,PROD:!0,THEME:"mat",MODE:"spa",VUE_ROUTER_MODE:"history",VUE_ROUTER_BASE:"/",APP_URL:"undefined"}).BUILD?r("y2mG").withParams:r("AjSV").withParams,i=n;t.default=i},iHEO:function(e,t,r){"use strict";r.r(t);var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("q-page",{staticClass:"row justify-center"},[r("q-card",{staticClass:"text-primary black-shadow col-xs-12 col-sm-8 col-md-6 q-ma-sm",attrs:{inline:""}},[r("q-card-title",{},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-4"},[e._v("Step 1")]),r("div",{staticClass:"col-8",staticStyle:{color:"White"}},[e._v("CREATE YOUR ACCOUNT")])])]),r("q-card-main",[r("q-field",{staticClass:"q-mb-sm",attrs:{icon:"person",error:e.$v.form.name.$error,"error-label":e.getError("name")}},[r("q-input",{attrs:{"float-label":e.$t("auth.name")},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}})],1),r("q-field",{staticClass:"q-mb-sm",attrs:{icon:"email",error:e.$v.form.email.$error,"error-label":e.getError("email")}},[r("q-input",{attrs:{"float-label":e.$t("auth.email")},on:{input:function(t){e.$v.form.email.$touch()},blur:function(t){e.$v.form.email.$touch()}},model:{value:e.form.email,callback:function(t){e.$set(e.form,"email",t)},expression:"form.email"}})],1),r("q-field",{staticClass:"q-mb-sm",attrs:{icon:"lock",error:e.$v.form.password.$error,"error-label":e.getError("password")}},[r("q-input",{attrs:{type:"password","float-label":e.$t("auth.password")},model:{value:e.form.password,callback:function(t){e.$set(e.form,"password",t)},expression:"form.password"}})],1),r("q-field",{staticClass:"q-mb-sm",attrs:{icon:"lock",error:e.$v.form.password_confirmation.$error,"error-label":e.getError("password_confirmation")}},[r("q-input",{attrs:{type:"password","float-label":e.$t("auth.confirm")},model:{value:e.form.password_confirmation,callback:function(t){e.$set(e.form,"password_confirmation",t)},expression:"form.password_confirmation"}})],1),r("q-alert",{staticClass:"q-my-lg",staticStyle:{position:"relative",display:"none"},attrs:{actions:[{label:"$4.99/month"}]}},[r("strong",[e._v("Full Access for ONLY")]),r("span",{staticStyle:{display:"block",background:"white",color:"gray","font-size":"13px",padding:"5px",position:"absolute",left:"0",bottom:"-13px"}},[e._v("Rebiled automaticaly each month for $4.99")])]),r("q-field",{staticClass:"q-mb-sm",attrs:{error:e.$v.form.checked.$error,"error-label":e.getError("checked")}},[r("q-checkbox",{staticStyle:{color:"#979797"},attrs:{label:"I have read and agree to the"},model:{value:e.form.checked,callback:function(t){e.$set(e.form,"checked",t)},expression:"form.checked"}}),r("q-btn",{staticClass:"q-px-xs q-ml-xs",attrs:{color:"white",flat:"",to:{name:"page",params:{link:"terms"}},label:"terms of conditions"}})],1)],1),r("q-card-actions",{staticClass:"block text-center"},[r("q-btn",{staticClass:"q-mt-md q-ml-md",attrs:{color:"primary",label:"Continue"},on:{click:e.submit}})],1),r("q-card-main",[r("h5",{staticClass:"q-ma-none",staticStyle:{color:"#999"}},[e._v("Member Benefits")]),r("div",{staticClass:"row"},e._l(e.benefits,function(t,n){return r("div",{key:n,staticClass:"col-12 col-sm-6 col-md-4"},[r("ul",e._l(t,function(t,n){return r("li",{key:n,staticStyle:{color:"#cbcbcb"},domProps:{textContent:e._s(t)}})}))])}))])],1)],1)},i=[];n._withStripped=!0;var a=r("MVZn"),o=r.n(a),u=(r("tUrg"),r("ta7f")),s=r("L2JU"),l=null,f=function(e){return!u["helpers"].req(e)||e!=l},c=function(e){return!u["helpers"].req(e)||1==e},d={validations:{form:{name:{required:u["required"]},email:{required:u["required"],email:u["email"],user:f},checked:{mustBeChecked:c},password:{required:u["required"],minLength:Object(u["minLength"])(6)},password_confirmation:{required:u["required"],same:Object(u["sameAs"])("password")}}},mounted:function(){var e=this.$router.currentRoute.params?this.$router.currentRoute.params.param:"";this.me&&"premium"==e&&(this.me.subscribed?this.$router.push("/"):this.getPayLink().then(function(e){return window.location.href=e.link}))},methods:o()({},Object(s["b"])({register:"auth/register",getPayLink:"subscribe/getPayLink"}),{getError:function(e){var t=this.$v.form[e];switch(e){case"name":if(!t.required)return this.$t("error.require",{field:e});break;case"email":if(!t.required)return this.$t("error.require",{field:e});if(!t.email)return this.$t("error.email",{field:e});if(!t.user)return this.$t("error.emailUsed",{field:e});break;case"password":if(!t.required)return this.$t("error.require",{field:e});if(!t.minLength)return this.$t("error.minLength",{minLength:6});break;case"password_confirmation":if(!t.required)return this.$t("error.require",{field:"confirm"});if(!t.same)return this.$t("error.sameAs",{field:"password"});break;case"checked":if(!t.mustBeChecked)return"You must accept term";break}return null},submit:function(){var e=this;this.$v.form.$touch(),this.$v.form.$error?this.$q.notify(this.$t("error.checkFields")):this.register(this.form).then(function(){var t=e.$router.currentRoute.params?e.$router.currentRoute.params.param:"";"free"==t?e.$router.push("/"):e.getPayLink().then(function(e){return window.location.href=e.link})}).catch(function(t){500==t.status&&t.data.errors.email&&(l=e.form.email,e.form.email="",e.form.email=l)})}}),computed:o()({},Object(s["c"])({lastPath:"auth/entryFrom",me:"auth/me",link:"subscribe/link"})),data:function(){return{benefits:[["HD Videos","FULLY Nude","Muscle Diagram"],["Online Support","User engagement","Downloadable workouts"],["No Advertisement","Exercise Library","New Video Update"]],form:{name:"",email:"",password:"",password_confirmation:"",checked:!1}}}},m=d,p=(r("y2sR"),r("KHd+")),b=Object(p["a"])(m,n,i,!1,null,null,null);b.options.__file="register.vue";t["default"]=b.exports},kdPC:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:":";return(0,n.withParams)({type:"macAddress"},function(t){if(!(0,n.req)(t))return!0;if("string"!==typeof t)return!1;var r="string"===typeof e&&""!==e?t.split(e):12===t.length||16===t.length?t.match(/.{2}/g):null;return null!==r&&(6===r.length||8===r.length)&&r.every(a)})};t.default=i;var a=function(e){return e.toLowerCase().match(/^[0-9a-f]{2}$/)}},qoKy:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(e){return(0,n.withParams)({type:"requiredIf",prop:e},function(t,r){return!(0,n.ref)(e,this,r)||(0,n.req)(t)})};t.default=i},ta7f:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),Object.defineProperty(t,"alpha",{enumerable:!0,get:function(){return n.default}}),Object.defineProperty(t,"alphaNum",{enumerable:!0,get:function(){return i.default}}),Object.defineProperty(t,"numeric",{enumerable:!0,get:function(){return a.default}}),Object.defineProperty(t,"between",{enumerable:!0,get:function(){return o.default}}),Object.defineProperty(t,"email",{enumerable:!0,get:function(){return u.default}}),Object.defineProperty(t,"ipAddress",{enumerable:!0,get:function(){return s.default}}),Object.defineProperty(t,"macAddress",{enumerable:!0,get:function(){return l.default}}),Object.defineProperty(t,"maxLength",{enumerable:!0,get:function(){return f.default}}),Object.defineProperty(t,"minLength",{enumerable:!0,get:function(){return c.default}}),Object.defineProperty(t,"required",{enumerable:!0,get:function(){return d.default}}),Object.defineProperty(t,"requiredIf",{enumerable:!0,get:function(){return m.default}}),Object.defineProperty(t,"requiredUnless",{enumerable:!0,get:function(){return p.default}}),Object.defineProperty(t,"sameAs",{enumerable:!0,get:function(){return b.default}}),Object.defineProperty(t,"url",{enumerable:!0,get:function(){return y.default}}),Object.defineProperty(t,"or",{enumerable:!0,get:function(){return h.default}}),Object.defineProperty(t,"and",{enumerable:!0,get:function(){return v.default}}),Object.defineProperty(t,"not",{enumerable:!0,get:function(){return O.default}}),Object.defineProperty(t,"minValue",{enumerable:!0,get:function(){return g.default}}),Object.defineProperty(t,"maxValue",{enumerable:!0,get:function(){return P.default}}),Object.defineProperty(t,"integer",{enumerable:!0,get:function(){return _.default}}),Object.defineProperty(t,"decimal",{enumerable:!0,get:function(){return w.default}}),t.helpers=void 0;var n=$(r("YjXl")),i=$(r("OlTG")),a=$(r("RbiO")),o=$(r("7BF0")),u=$(r("XXVU")),s=$(r("yZ1b")),l=$(r("kdPC")),f=$(r("KhKh")),c=$(r("XbO3")),d=$(r("1PTn")),m=$(r("qoKy")),p=$(r("5lKX")),b=$(r("tsu9")),y=$(r("dy1E")),h=$(r("0pQ5")),v=$(r("M2AK")),O=$(r("ZBfT")),g=$(r("62b2")),P=$(r("RryX")),_=$(r("EzHr")),w=$(r("wwGG")),q=j(r("eO9T"));function j(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var r in e)if(Object.prototype.hasOwnProperty.call(e,r)){var n=Object.defineProperty&&Object.getOwnPropertyDescriptor?Object.getOwnPropertyDescriptor(e,r):{};n.get||n.set?Object.defineProperty(t,r,n):t[r]=e[r]}return t.default=e,t}function $(e){return e&&e.__esModule?e:{default:e}}t.helpers=q},tsu9:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=function(e){return(0,n.withParams)({type:"sameAs",eq:e},function(t,r){return t===(0,n.ref)(e,this,r)})};t.default=i},wwGG:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=(0,n.regex)("decimal",/^[-]?\d*(\.\d+)?$/);t.default=i},y2mG:function(e,t,r){"use strict";(function(e){function r(e){return r="function"===typeof Symbol&&"symbol"===typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"===typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},r(e)}Object.defineProperty(t,"__esModule",{value:!0}),t.withParams=void 0;var n="undefined"!==typeof window?window:"undefined"!==typeof e?e:{},i=function(e,t){return"object"===r(e)&&void 0!==t?t:e(function(){})},a=n.vuelidate?n.vuelidate.withParams:i;t.withParams=a}).call(this,r("yLpj"))},y2sR:function(e,t,r){"use strict";var n=r("bkty"),i=r.n(n);i.a},yZ1b:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r("eO9T"),i=(0,n.withParams)({type:"ipAddress"},function(e){if(!(0,n.req)(e))return!0;if("string"!==typeof e)return!1;var t=e.split(".");return 4===t.length&&t.every(a)});t.default=i;var a=function(e){if(e.length>3||0===e.length)return!1;if("0"===e[0]&&"0"!==e)return!1;if(!e.match(/^\d+$/))return!1;var t=0|+e;return t>=0&&t<=255}}}]);