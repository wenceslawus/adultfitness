(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[25],{RGr0:function(t,e,a){},dd6L:function(t,e,a){"use strict";var r=a("RGr0"),s=a.n(r);s.a},xmsq:function(t,e,a){"use strict";a.r(e);var r=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("q-layout",{staticClass:"site black",attrs:{view:"lHh Lpr lFf"}},[a("q-layout-header",[a("a-general-toolbar",{attrs:{page:t.pageName}})],1),a("a-mobile-drawer"),a("a-mobile-notify"),a("q-page-container",{staticStyle:{"padding-top":"64px !important"}},[t.userData?a("div",{staticClass:"container"},[a("q-card",{staticClass:"profile_card"},[a("q-card-media",{staticClass:"relative-position"},[a("q-btn",{staticClass:"absolute",staticStyle:{top:"5px",right:"5px"},attrs:{fab:"",flat:"",type:"a",icon:"photo_camera",color:"white"},on:{click:t.changeWallpaper}}),a("img",{attrs:{itemprop:"image",src:t.wallpaper,alt:"nude training"}})],1),a("q-card-title",{staticClass:"relative-position",staticStyle:{"padding-top":"2px"}},[a("img",{staticClass:"photo_profile absolute",attrs:{itemprop:"image",src:t.avatar,alt:"adult fitness"},on:{click:t.changePhoto}}),t.sheeld?a("span",{staticClass:"proSheeld",domProps:{textContent:t._s(t.sheeld)}}):t._e(),a("div",{staticClass:"controls row justify-between items-start"},[a("div",{staticClass:"userProps relative-position"},[t.userData?a("div",{staticClass:"data"},[a("div",{staticClass:"userName"},[t._v(t._s(t.userData.name))]),t.userData.followers?a("div",{staticClass:"followers",staticStyle:{"font-size":"12px","line-height":"12px"}},[t._v(t._s(t.userData.followers)+" followers")]):t._e()]):t._e()]),a("div",{staticClass:"btns row justify-end"},t._l(t.auth_btns,function(e,r){return a("q-btn",{key:r,class:{active:t.pageName==e.route},attrs:{type:"a",size:"md",glossy:"",label:e.label},on:{click:function(a){t.goTo(e)}}})}))])])],1)],1):t._e(),a("router-view",{staticClass:"justify-start"})],1),a("a-footer")],1)},s=[];r._withStripped=!0;a("f3/d");var i=a("cDf5"),o=a.n(i),n=a("MVZn"),l=a.n(n),u=a("MUWh"),c=a("4bl9"),p=a("hUN+"),h=a("L2JU"),f=a("B+JZ"),d=a("IWON"),m={components:{"a-general-toolbar":u["a"],"a-footer":p["a"],"a-banner":c["a"],"a-mobile-drawer":f["a"],"a-mobile-notify":d["a"]},computed:l()({},Object(h["c"])({meAvatar:"auth/avatar",userData:"auth/me",musculeGroup:"video/groups",user:"auth/me",avatar:"auth/avatar",notifies:"notify/list",_showDrawer:"general/showDrawer"}),{showDrawer:{get:function(){return this._showDrawer},set:function(t){console.log(t),this.toggleDrawer(t)}},sheeld:function(){var t="user";return this.userData&&this.userData.role&&(t=this.userData.role),console.log(t),"trainer"==t||"admin"==t?"Trainer":null},wallpaper:function(){return console.log("user",this.userData),this.userData&&this.userData.wallpaper?this.userData.wallpaper:"/statics/profile_top.png"},avatar:function(){return this.userData&&this.userData.avatar?this.userData.avatar:"/statics/profile.png"},auth_btns:function(){var t=this;return"me"==this.trainer_id?this.btns.filter(function(e){if(!e.permit)return!0;var a=t.userData.role;switch(e.permit){case"upload":return"admin"==a||"trainer"==a;case"trainer":return"admin"==a||"trainer"==a}return!0}):this.btns_public.filter(function(t){return!t.permit||"training"==t.permit})},menuItems:function(){var t=this;return this.mItems.filter(function(e){if(!e.permit)return!0;if(!t.user)return!1;switch(e.permit){case"upload":return"admin"==t.user.role||"trainer"==t.user.role}return!0})},visible:function(){var t=this.pageName;return!("register"==t||"register.update"==t||"training.list"==t)},unreadCount:function(){return this.notifies.reduce(function(t,e){var a=0;return"object"==o()(t)?0==(1&t.state)&&(a=1):a=t,0==(1&e.state)&&a++,console.log(o()(t),0==(1&t.state),a),a})}}),watch:{$route:function(t,e){}},name:"layout",data:function(){return{pageName:"",searchText:"",rightDrawerOpen:!1,trainer_id:"me",btns:[{label:"Home",route:"profile.home",permit:"trainer"},{label:"Saved videos",route:"profile.saved"},{label:"My PlayList",route:"profile.list"},{label:"Settings",route:"profile.settings"},{label:"Uploads",route:"profile.videos",permit:"upload"},{label:"About",route:"profile.me",permit:"trainer"}]}},mounted:function(){this.updatePageName(this.$router.history.current)},methods:l()({},Object(h["b"])({showSubscribe:"subscribe/showDialog",selectFile:"upload/selectAvatar",selectWallpaper:"upload/selectWallpaper",setAvatar:"auth/avatar",setWallpapers:"auth/wallpaper",sendFollow:"training/follow",getTrainer:"training/getTrainer",setTrainer:"training/setTrainer",clearTrainer:"training/clearTrainer",markRead:"notify/markRread",toggleDrawer:"general/toggleDrawer",subscribe:"subscribe/showDialog",nread:"notify/read",nremove:"notify/remove",_logout:"auth/logout"}),{logout:function(){var t=this;this._logout().then(function(){t.$router.push("/")})},dropNotify:function(){this.markRead()},changePhoto:function(){var t=this;this.selectFile(function(e){t.setAvatar(e)})},changeWallpaper:function(){var t=this;this.selectWallpaper(function(e){t.setWallpapers(e)})},updatePageName:function(t){var e=t.name;switch(e){case"blogs":this.pageName="blog";break;default:this.pageName=e;break}console.log("route",this.$router),this.$router.history.push(t)},follow:function(){var t=this;this.userData&&this.sendFollow({id:this.trainer_id,state:this.userData.followed?"unfollow":""}).then(function(e){t.$q.notify({message:t.userData.followed?"You subscribe":"You are unsubscribed",color:"positive"})})},tryOpenPrograms:function(){this.user&&this.user.subscribed?this.$router.push({name:"training.list"}):this.subscribe(!0)},tryRedirect:function(t){var e=this,a=t.name,r="training.list"==a;this.user?this.user.subscribed||!r?this.$router.push(t):this.subscribe(!0):(console.log("r",this.$router.currentRoute),this.setEntry(this.$router.currentRoute.path).then(function(){return e.$router.push({name:"login"})}))},readMessage:function(t){var e=this;this.nread(t.id).then(function(){t.route&&e.$router.push({name:t.route,params:t.param}),e.$q.dialog({title:"Notify",message:t.text,ok:{push:!0,label:"Delete",color:"negative"},cancel:"Ok"}).then(function(){e.nremove(t.id)}).catch(function(){})}),console.log("msg",t)},goTo:function(t){this.updatePageName({name:t.route,params:t.params})}})},g=m,b=(a("dd6L"),a("KHd+")),v=Object(b["a"])(g,r,s,!1,null,null,null);v.options.__file="profile.vue";e["default"]=v.exports}}]);