(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{"/wrq":function(t,a){t.exports="/images/_/_/_/_/dhahaprima/resources/js/src/assets/images/pages/bg_login.png"},"5ZHy":function(t,a,e){var n=e("hvR4");"string"==typeof n&&(n=[[t.i,n,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(n,r);n.locals&&(t.exports=n.locals)},Av6N:function(t,a,e){"use strict";e.r(a);e("6cQw"),e("rB9j"),e("UxlC"),e("sMBO"),e("ma9I");var n=e("e7F3"),r=e("OOfG"),s=e("JhbM"),i=e("oVt+"),o=e("sove"),l=e("qlm0"),A=e("giZP"),u=e("R5cT"),d=e("zMAm"),g=e("XhI9"),p=e("w+YJ"),c=e("1uQM"),h=e("SWgu"),m=e("ugaB"),f=e("SRip"),v=e("Ed67"),b=e("GUe+"),w=e("X9p1"),x=e("AeMN"),C=e("g2Gq"),B=e("mwM1"),I=(e("XTZb"),e("TJPC")),N=e("1NcB"),y=e("JZPS"),Z=(e("ALS0"),Object(n.c)("required",I.l)),j=Object(n.c)("email",I.g);Object(n.c)("min",I.j),Object(n.c)("confirmed",I.e),Object(n.c)("regex",I.k),Object(n.c)("between",I.d),Object(n.c)("alpha",I.a),Object(n.c)("integer",I.h),Object(n.c)("digits",I.f),Object(n.c)("alpha-dash",I.b),Object(n.c)("alpha-num",I.c),Object(n.c)("length",I.i),Object(n.c)("positive",{validate:function(t){return t>=0},message:"Please enter positive number!"}),Object(n.c)("credit-card",{validate:function(t){return/^(?:3[47][0-9]{13})$/.test(t)},message:"It is not valid credit card!"}),Object(n.c)("password",{validate:function(t){return/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*()]).{8,}/.test(t)},message:"Your {_field_} must contain at least one uppercase, one lowercase, one special character and one digit"}),Object(n.c)("url",{validate:function(t){if(null==t||0===t.length)return!0;return/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/.test(t)},message:"URL is invalid"});Object(n.d)({en:{messages:y.messages,names:{email:"Email",password:"Password"},fields:{password:{min:"{_field_} is too short, you want to get hacked?"}}},ar:{messages:N.messages,names:{email:"البريد الإلكتروني",password:"كلمة السر"},fields:{password:{min:"كلمة السر قصيرة جداً سيتم اختراقك"}}}});var R=e("tvh2"),E=(e("s7eH"),e("+r6/"),{components:{BAvatar:e("6KOa").a},props:{variant:{type:String,default:"primary"},icon:{type:String,default:null},title:{type:String,default:null},text:{type:String,default:null},hideClose:{type:Boolean,default:!1}}}),G=(e("B5js"),e("KHd+")),k=Object(G.a)(E,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"toastification"},[e("div",{staticClass:"d-flex align-items-start"},[e("b-avatar",{staticClass:"mr-75 flex-shrink-0",attrs:{variant:t.variant,size:"1.8rem"}},[e("feather-icon",{attrs:{icon:t.icon,size:"15"}})],1),t._v(" "),e("div",{staticClass:"d-flex flex-grow-1"},[e("div",[t.title?e("h5",{staticClass:"mb-0 font-weight-bolder toastification-title",class:"text-"+t.variant,domProps:{textContent:t._s(t.title)}}):t._e(),t._v(" "),t.text?e("small",{staticClass:"d-inline-block text-body",domProps:{textContent:t._s(t.text)}}):t._e()]),t._v(" "),e("span",{staticClass:"cursor-pointer toastification-close-icon ml-auto ",on:{click:function(a){return t.$emit("close-toast")}}},[t.hideClose?t._e():e("feather-icon",{staticClass:"text-body",attrs:{icon:"XIcon"}})],1)])],1)])}),[],!1,null,"5044ad47",null).exports,Y={directives:{"b-tooltip":s.a},components:{BRow:i.a,BCol:o.a,BLink:l.a,BFormGroup:A.a,BFormInput:u.a,BInputGroupAppend:d.a,BInputGroup:g.a,BFormCheckbox:p.a,BCardText:c.a,BCardTitle:h.a,BCardSubTitle:m.a,BImg:f.a,BForm:v.a,BButton:b.a,BAlert:w.a,VuexyLogo:r.a,ValidationProvider:n.b,ValidationObserver:n.a,BSpinner:x.a,BFormSelect:C.a,BOverlay:B.a},mixins:[{data:function(){return{passwordFieldType:"password"}},methods:{togglePasswordVisibility:function(){this.passwordFieldType="password"===this.passwordFieldType?"text":"password"}}}],data:function(){return{busy:!0,show:!0,status:"",password:"",userEmail:"",semester_id:"",sideImg:e("/wrq"),logoImg:e("/VGv"),required:Z,email:j,app:R.a.state.appConfig.app}},computed:{passwordToggleIcon:function(){return"password"===this.passwordFieldType?"EyeIcon":"EyeOffIcon"},imgUrl:function(){return this.sideImg},appName:function(){return console.log("login:",app_name),app_name},logoUrl:function(){return this.logoImg}},methods:{login:function(){var t=this;this.show=!1,this.$refs.loginForm.validate().then((function(a){a&&t.$http.post("/auth/login",{email:t.userEmail,password:t.password,semester_id:t.semester_id}).then((function(a){var e=a.data;if(e.user){localStorage.setItem("accessToken",e.accessToken),localStorage.setItem("refreshToken",e.accessToken),localStorage.setItem("userData",JSON.stringify(e.user)),t.$ability.update(e.user.ability),t.show=!0;t.$router.replace("/dashboard").then((function(){t.$toast({component:k,position:"bottom-center",props:{title:"Selamat Datang ".concat(e.user.name),icon:"CoffeeIcon",variant:"success",text:"Anda telah berhasil masuk sebagai ".concat(e.user.role,". Sekarang Anda dapat mulai berselancar di Aplikasi ").concat(t.app.name,"!")}})}))}else t.show=!0,e.errors&&(e.errors.username&&t.$refs.loginForm.setErrors({email:e.errors.username[0]}),e.errors.email&&t.$refs.loginForm.setErrors({email:e.errors.email[0]})),t.$refs.loginForm.setErrors(e.message)})).catch((function(a){t.show=!0,t.$refs.loginForm.setErrors(a.response.data.errors)}))}))}}},Q=(e("yhZC"),Object(G.a)(Y,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"auth-wrapper auth-v2"},[e("b-row",{staticClass:"auth-inner m-0"},[e("b-link",{staticClass:"brand-logo"},[e("vuexy-logo"),t._v(" "),e("h2",{staticClass:"brand-text text-dark ml-1"},[t._v("\n        "+t._s(t.appName)+"\n      ")])],1),t._v(" "),e("b-col",{staticClass:"d-none d-lg-flex align-items-center p-5",attrs:{lg:"8"}},[e("div",{staticClass:"w-100 d-lg-flex align-items-center justify-content-center px-5"},[e("b-img",{attrs:{fluid:"",src:t.imgUrl,alt:"Login V2"}})],1)]),t._v(" "),e("b-col",{staticClass:"d-flex align-items-center auth-bg px-2 p-lg-5",attrs:{lg:"4"}},[e("b-col",{staticClass:"px-xl-2 mx-auto",attrs:{sm:"8",md:"6",lg:"12"}},[e("div",{staticClass:"text-center"},[e("b-card-title",{staticClass:"mb-1 font-weight-bold",attrs:{"title-tag":"h1"}},[e("b-img",{staticStyle:{height:"28px"},attrs:{src:t.logoUrl}}),t._v(" "+t._s(t.appName)+"\n          ")],1),t._v(" "),e("b-card-text",{staticClass:"my-1"},[t._v("\n            Silahkan login untuk dapat mengakses Aplikasi\n          ")])],1),t._v(" "),e("validation-observer",{ref:"loginForm",scopedSlots:t._u([{key:"default",fn:function(a){var n=a.invalid;return[e("b-form",{staticClass:"auth-login-form mt-2",on:{submit:function(a){return a.preventDefault(),t.login(a)}}},[e("b-form-group",{attrs:{label:"Email","label-for":"login-email"}},[e("validation-provider",{attrs:{name:"Email",vid:"email",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(a){var n=a.errors;return[e("b-form-input",{attrs:{id:"login-email",state:!(n.length>0)&&null,name:"login-email",placeholder:"Email/Username"},model:{value:t.userEmail,callback:function(a){t.userEmail=a},expression:"userEmail"}}),t._v(" "),e("small",{staticClass:"text-danger"},[t._v(t._s(n[0]))])]}}],null,!0)})],1),t._v(" "),e("b-form-group",{attrs:{label:"Password","label-for":"login-password"}},[e("validation-provider",{attrs:{name:"Password",vid:"password",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(a){var n=a.errors;return[e("b-input-group",{staticClass:"input-group-merge",class:n.length>0?"is-invalid":null},[e("b-form-input",{staticClass:"form-control-merge",attrs:{id:"login-password",state:!(n.length>0)&&null,type:t.passwordFieldType,name:"login-password",placeholder:"Password"},model:{value:t.password,callback:function(a){t.password=a},expression:"password"}}),t._v(" "),e("b-input-group-append",{attrs:{"is-text":""}},[e("feather-icon",{staticClass:"cursor-pointer",attrs:{icon:t.passwordToggleIcon},on:{click:t.togglePasswordVisibility}})],1)],1),t._v(" "),e("small",{staticClass:"text-danger"},[t._v(t._s(n[0]))])]}}],null,!0)})],1),t._v(" "),e("b-form-group",[e("b-form-checkbox",{attrs:{id:"remember-me",name:"checkbox-1"},model:{value:t.status,callback:function(a){t.status=a},expression:"status"}},[t._v("\n                Simpan Login\n              ")])],1),t._v(" "),e("b-button",{directives:[{name:"show",rawName:"v-show",value:t.show,expression:"show"}],attrs:{type:"submit",variant:"success",block:"",disabled:n}},[t._v("\n              Login\n            ")]),t._v(" "),e("b-button",{directives:[{name:"show",rawName:"v-show",value:!t.show,expression:"!show"}],attrs:{variant:"success",block:"",disabled:""}},[e("b-spinner",{attrs:{small:"",type:"grow"}}),t._v("\n              Proses loggin...\n            ")],1)],1)]}}])})],1)],1)],1)],1)}),[],!1,null,null,null));a.default=Q.exports},B5js:function(t,a,e){"use strict";e("BYqo")},BYqo:function(t,a,e){var n=e("LsaF");"string"==typeof n&&(n=[[t.i,n,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(n,r);n.locals&&(t.exports=n.locals)},LsaF:function(t,a,e){(a=e("JPst")(!1)).push([t.i,".toastification-close-icon[data-v-5044ad47], .toastification-title[data-v-5044ad47] {\n  line-height: 26px;\n}\n.toastification-title[data-v-5044ad47] {\n  color: inherit;\n}",""]),t.exports=a},OOfG:function(t,a,e){"use strict";var n={components:{BImg:e("SRip").a},data:function(){return{sideImg:e("/VGv")}},computed:{imgUrl:function(){return this.sideImg}}},r=e("KHd+"),s=Object(r.a)(n,(function(){var t=this.$createElement;return(this._self._c||t)("b-img",{attrs:{src:this.imgUrl,height:"24",alt:"Logo"}})}),[],!1,null,null,null);a.a=s.exports},hvR4:function(t,a,e){(a=e("JPst")(!1)).push([t.i,'.auth-wrapper {\n  display: flex;\n  flex-basis: 100%;\n  min-height: 100vh;\n  min-height: calc(var(--vh, 1vh) * 100);\n  width: 100%;\n}\n.auth-wrapper .auth-inner {\n  width: 100%;\n  position: relative;\n}\n.auth-wrapper.auth-v1 {\n  align-items: center;\n  justify-content: center;\n  overflow: hidden;\n}\n.auth-wrapper.auth-v1 .auth-inner:before {\n  width: 244px;\n  height: 243px;\n  content: " ";\n  position: absolute;\n  top: -54px;\n}\n[dir] .auth-wrapper.auth-v1 .auth-inner:before {\n  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPQAAADzCAMAAACG9Mt0AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAA9KADAAQAAAABAAAA8wAAAADhQHfUAAAAyVBMVEUAAAD///+AgP+AgP9mZv+AgNWAgP9tbf9gYP+AgP9xcf9mZv+AZuaAgP9dXf90dOhiYv92dv9mZu5mZv93d+53d/9paf94afCAcfFrXvJra/9mZvJzZvJzc/JoaP96b/Rqav91aupsYvV2bOt2bPVxaPZ7cfZqavZyau1waPd4aO9xafBxafh4afB1bfh4avFuZ/F2afJzZvJzZ/N0aPN0bvN3bPR0ae5yZ/R3be93bfR1au9zafBxbPVzavV0a/F0a/ZyafFwaPKZm3nTAAAAQ3RSTlMAAQIEBQYGBwgICQoKCgsLDQ0PDw8PERESExMUFBQWFxgYGhoaGxsdHSAgIiIiIyQlJygqLCwtLi8vLzAzNDU3Nzg7h9vbHgAAA9RJREFUeNrt3ftS2kAUx/Fc1gSyWsErtuJdRDQiiteolb7/QzUoTm07k4AzObuu3/MCez45yWbzT36eZ6b8erO1e1B97baadd+zocJWmg0HaXe/+uqmg2GWtkLT5Lle1m9LdhG2+1lvzuiUO1knEF81yFc1N+35m15kZOGodz1vyLx+v2Lseq/erxtZd/NuweCTtfiwaWLOD5FnsqI7+VnP3y8afnEs3Es/1+H1qvETwuq18B7e6VlwLup1ZM8kWWQBOsrmHL7GVtxvYRZYgQ4ywae61ffsqH5Lbq20bQm6ncp9P2ehJegwE/u+rl95ttSwLrVSc2ANetAU28dSa9Cp2E623bUG3d2VWmn/wBq0XCugQYMGLdVKoOJaoiuok1NdXSW1WAUfRPtRUllflaJf5ZE/O9pXVbZUPTov5c+IDqvtRwStdTgLutoxy6GnGfYb2o+1I2gd+1OiqzfLocvVE7TSDqG1mgodaqfQZbvZC9rXjqG1X45WzqFVKVpk0LLo4lGP0ZGD6KgMnTiITkrQgXYQrYNitHISrYrRsZPouBhdcxJdK0YnTqKTYrR2Eq1BgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRoh9DH59ag86ACoSYOL61B55EUQk1s3VqDzsNHhJpYe7QGncfMSHUxaliCHgcKSXVxeWQJehwdJdXF4dAS9DgkTKqLxuibFeiXODixNi7OrEC/BP+JtbE0WrYA/RrxKNfH2YUF6NegSbk+Gk87xtErN6EsWm88fzeMXpwE9EruLns/l42io4dJFLPo2/Po1w+D6IW7t9Bt2SPx3vOOMfS7eHVZtN54ulg2go56138Ct4XRunE2Ovsmjg46WeddUoUWr6WL0fCoIYgO2/2s91fstDZQjcPL0ePt5flpdXUwqW46uMrS1j95JNpQrW0dHp9UV/uT2m416/8HVGg3qzhpBjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KC/FDpx0pwUo2tOomvF6NhJdFyMVk6iVTE6cBIdeF9vJyvZx/I/AzuIjsrQvoNovwzt4FamSs0Ojrp80PmvoB0zh940pb7azf1yg7t0LIt978uppzbnalfucDW92ZndLPRmKweGPduYJ+zoM5/Dk+gD5NdvLhXXPp88qcUqmEH5G5JZRs6cuxwIAAAAAElFTkSuQmCC");\n}\n[dir=ltr] .auth-wrapper.auth-v1 .auth-inner:before {\n  left: -46px;\n}\n[dir=rtl] .auth-wrapper.auth-v1 .auth-inner:before {\n  right: -46px;\n}\n@media (max-width: 575.98px) {\n.auth-wrapper.auth-v1 .auth-inner:before {\n    display: none;\n}\n}\n.auth-wrapper.auth-v1 .auth-inner:after {\n  width: 272px;\n  height: 272px;\n  content: " ";\n  position: absolute;\n  bottom: -55px;\n  z-index: -1;\n}\n[dir] .auth-wrapper.auth-v1 .auth-inner:after {\n  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARAAAAEQCAMAAABP1NsnAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAABEKADAAQAAAABAAABEAAAAAAQWxS2AAAAwFBMVEUAAAD///+AgICAgP9VVaqqVf+qqv+AgL+AgP9mZsxmZv+ZZv+AgNWAgP9tbdttbf+Sbf+AYN+AgN+AgP9xceNmZv+AZuaAZv90dOh0dP9qav+AauqAav+AgP92dv9tbf+Abe2Abf93Zu53d+6AcO94afCAcfF5a+R5a/JzZuaAZvKAc/J5bed5bfOAaPN6b/R1auqAavR6ZvV6cPV2bOuAbPV7aPZ2be2AbfZ7au17avZ3Zu53b+57a+97a/d4aO9J6CoeAAAAQHRSTlMAAQICAwMDBAQFBQUGBgcHBwgICAkKCgoLCwwMDAwNDg4ODw8QERITExQUFBUVFhcYGBkZGhobHBwdHR4eHx8gJ5uMWwAAA/FJREFUeNrt2G1XEkEYxvHZNk2xHGzdbKFl0cTwgdSkCKzu7/+t4pw6sAjtjIueE/f8r3fMO35nZnbuy5gVGcvfzJe0rnTfGI+MggGJRUZnbpPIhJKt88nU53JnFULvyISY6KAv8vPj0vr2rYwiE2Z2B9J+uNYcyyQxwWZvaeGH3G4bMjsvI/kcwTC/V+7kLoahlITzQojP3ZFgsJCh7IJQzpX0QFj4uMiY18eDMZ9bZCF9OQahnK6cm/Y7js0sh/LF3Auv1PlQd3MxbdXYIQspV44EEEAAAWTNDAYYkKdJbNMsLzYueZbaZ2iM46RVbHBaiZ9Js+nHEdli42N9XuSen5hGp1CQTuOJQDRsD99N4gMSpYWapNH6IJo83CIeILZQFesEaber79NCWRoukOpNEnW0gXQqD81w6ACxhbrYde7VuFCYeA2QRCNIsgZISyNIqz6IyhPjOjNVIFYniK3dmKU6QdLaJUimEySrDZLrBMlrgxRKU7sxCw/EMe0CAggggADySJCqxixIkKpNEh6IozELD8RxjQACCCCAAPJIkKrGLEgQXqqAAEJjxrQLCCCAAEJjRmNGY8a0CwgggABCYwYIfQgggNCYMe0CAggggNCY0ZjRmDHtAgIIIIAAQmNGHwIIIDRmTLuAAAIIIDRmNGY0Zky7gAACCCCA0JjRhwACCI0Z0y4ggAACCI0ZjRmNGdMuIIAAAgggNGb0IYAAQmPGtAsIIIAAQmNGY0ZjxrQLCCCAAAIIjRl9CCCA0Jgx7QICCCCA0JjRmNGYMe0CAggggABCY0YfAgggNGZMu4AAAgggNGY0ZjRmTLuAAAIIIIDQmNGHAAIIjRnTLiCAAAIIjRmNGY0ZIEy7gAACCCA0ZvQhgABCY8a0CwgggABCY0ZjBgiNGdMuIIAAAgiN2f/Sh+Q6PfLaIJlOkKw2SKoTJK3dmFmdILb2tBvrBIlrg5iWRo+WqQ+SaARJ1gCJAzsxThCN16p1vNurGjNjoo42j07kAHFskoY2kEbl33U0ZgoPjXW+Rl0gkarnahqtDaJKxMPDDWIiNafGenh4gExvVhXfmk7Da6L1AVGxSby2h6MxK79Zk42ea1pJbJ48sU2zDezQ8iy1z6BBwoyjMQsvXp8YQAAhgADilRfyy+wf8WqZZUfGZihvgZiB3FybC+kCUU5XLkAo50C+gbBQdUzkAIVyejIAYfFTI1solHP2HgNCnHn5AYNy4jvpoVB6fVzL91cwzLJ9Lfd7S0jhehxO5H5/yePr1W6gHonI7fJ5ORSR/n6Q2yQanq763zuXU5LJZRKiyD/W9/pjkdPZz0/yJ8fqVyry+qQZDMjJKoDfy8bRVhHhQTwAAAAASUVORK5CYII=");\n}\n[dir=ltr] .auth-wrapper.auth-v1 .auth-inner:after {\n  right: -75px;\n}\n[dir=rtl] .auth-wrapper.auth-v1 .auth-inner:after {\n  left: -75px;\n}\n@media (max-width: 575.98px) {\n.auth-wrapper.auth-v1 .auth-inner:after {\n    display: none;\n}\n}\n.auth-wrapper.auth-v2 {\n  align-items: flex-start;\n}\n.auth-wrapper.auth-v2 .auth-inner {\n  height: 100vh;\n  overflow-y: auto;\n  height: calc(var(--vh, 1vh) * 100);\n}\n.auth-wrapper.auth-v2 .brand-logo {\n  position: absolute;\n  top: 2rem;\n  z-index: 1;\n}\n[dir] .auth-wrapper.auth-v2 .brand-logo {\n  margin: 0;\n}\n[dir=ltr] .auth-wrapper.auth-v2 .brand-logo {\n  left: 2rem;\n}\n[dir=rtl] .auth-wrapper.auth-v2 .brand-logo {\n  right: 2rem;\n}\n.auth-wrapper.auth-v1 .auth-inner {\n  max-width: 400px;\n}\n.auth-wrapper .brand-logo {\n  display: flex;\n  justify-content: center;\n}\n[dir] .auth-wrapper .brand-logo {\n  margin: 1rem 0 2rem 0;\n}\n.auth-wrapper .brand-logo .brand-text {\n  font-weight: 600;\n}\n[dir] .auth-wrapper .auth-footer-btn .btn {\n  padding: 0.6rem !important;\n}\n[dir=ltr] .auth-wrapper .auth-footer-btn .btn:not(:last-child) {\n  margin-right: 1rem;\n}\n[dir=rtl] .auth-wrapper .auth-footer-btn .btn:not(:last-child) {\n  margin-left: 1rem;\n}\n@media (min-width: 1200px) {\n.auth-wrapper.auth-v2 .auth-card {\n    width: 400px;\n}\n}\n[dir] .auth-wrapper .auth-bg {\n  background-color: #fff;\n}\n[dir] .dark-layout .auth-wrapper .auth-bg {\n  background-color: #283046;\n}\n@media (max-height: 625px) {\n[dir] .dark-layout .auth-wrapper .auth-inner {\n    background-color: #283046;\n}\n[dir] .auth-wrapper .auth-bg {\n    padding-top: 3rem;\n}\n[dir] .auth-wrapper .auth-inner {\n    background-color: #fff;\n    padding-bottom: 1rem;\n}\n.auth-wrapper.auth-v2 .brand-logo {\n    width: 100%;\n    display: flex;\n    justify-content: unset;\n    position: relative;\n}\n[dir=ltr] .auth-wrapper.auth-v2 .brand-logo {\n    left: 0;\n    padding-left: 1.5rem;\n}\n[dir=rtl] .auth-wrapper.auth-v2 .brand-logo {\n    right: 0;\n    padding-right: 1.5rem;\n}\n}\n.brand-logo svg {\n  height: 28px;\n  width: 40.95px;\n}',""]),t.exports=a},yhZC:function(t,a,e){"use strict";e("5ZHy")}}]);