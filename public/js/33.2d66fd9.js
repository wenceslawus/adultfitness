(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[33],{"8ofV":function(e,t,i){},XSUy:function(e,t,i){"use strict";var n=i("8ofV"),a=i.n(n);a.a},uANZ:function(e,t,i){"use strict";i.r(t);var n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("q-page",{staticClass:"black flex flex-center"},[i("div",{staticClass:"container notifies"},[i("h3",[e._v("Your Notifications")]),i("q-list",{attrs:{separator:"",link:""}},[e.notifies.length?e._e():i("q-item",[i("q-item-main",[i("q-item-tile",{attrs:{label:"",lines:"1"}},[e._v("No messages")])],1)],1),e._l(e.notifies,function(t){return i("q-item",{directives:[{name:"close-overlay",rawName:"v-close-overlay"}],key:t.id,nativeOn:{click:function(i){e.readMessage(t)}}},[i("q-item-side",[i("img",{attrs:{itemprop:"image",src:t.source.avatar,alt:"adult fitness"}})]),i("q-item-main",[i("q-item-tile",{attrs:{label:""}},[i("b",[e._v(e._s(t.source.name))]),e._v(" "+e._s(t.text)),i("p",[e._v(e._s(t.dt))])])],1)],1)})],2)],1)])},a=[];n._withStripped=!0;var s=i("MVZn"),r=i.n(s),o=i("L2JU"),c={methods:r()({},Object(o["b"])({nread:"notify/read",nremove:"notify/remove"}),{readMessage:function(e){var t=this;this.nread(e.id).then(function(){e.route&&t.$router.push({name:e.route,params:e.param})})}}),computed:r()({},Object(o["c"])({notifies:"notify/list"})),data:function(){return{}}},l=c,u=(i("XSUy"),i("KHd+")),f=Object(u["a"])(l,n,a,!1,null,null,null);f.options.__file="notifies.vue";t["default"]=f.exports}}]);