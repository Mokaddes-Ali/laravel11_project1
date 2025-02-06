import{_ as B}from"./icon-pencil-3545a315.js";import{o as i,h as u,f as h,d as S,q as N,E as z,t as x,F as C,b,c as A,u as P,J as L,K as $,L as K,M as G,r as g,N as q,P as D,v as R,C as k,Q as U,y as H}from"./app-ab645692.js";import{_ as j}from"./_plugin-vue_export-helper-c27b6911.js";function V(t,e){return i(),u("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true","data-slot":"icon"},[h("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z"})])}const F=["onClick"],W=S({__name:"phrase-with-parameters",props:{copyable:{type:Boolean},phrase:{}},setup(t){function e(c){const s=document.getElementById("textArea"),o=s.scrollTop;let l=0;const r=s.selectionStart!=null?"ff":document.selection?"ie":!1;function f(){return r==="ie"?document.selection.createRange():document.createRange()}function n(p){if(r==="ie"){const v=f();v.moveStart("character",-s.value.length),v.moveStart("character",p),v.moveEnd("character",0),v.select()}else r==="ff"&&(s.selectionStart=p,s.selectionEnd=p,s.focus())}if(r==="ie"){s.focus();const p=f();p.moveStart("character",-s.value.length),l=p.text.length}else r==="ff"&&(l=s.selectionStart);const d=s.value.substring(0,l),y=s.value.substring(l,s.value.length);s.value=d+c+y,l=l+c.length,n(l),s.scrollTop=o}return(c,s)=>(i(!0),u(C,null,N(c.phrase,o=>(i(),u("div",{key:o.value,class:z(["flex items-center",{"text-gray-600":!o.parameter,"cursor-pointer":o.parameter&&c.copyable,"rounded bg-blue-50 px-1 py-px text-sm text-blue-600 hover:bg-blue-100":o.parameter}]),onClick:l=>c.copyable&&o.parameter&&e(o.value)},x(o.value),11,F))),128))}}),O={class:"flex w-full flex-row divide-x"},J={class:"mb-2 flex w-48 items-start px-4 py-3 md:w-80 xl:w-96"},Y={class:"flex w-full max-w-max overflow-hidden truncate rounded-md border"},Q=["textContent"],X={class:"flex flex-1 items-center px-3 py-2 text-base"},ee={key:0,class:"flex flex-wrap items-center gap-1"},te={key:1,class:"flex text-gray-600"},se=["href"],ne=S({__name:"similar-phrases-item",props:{phrase:{}},setup(t){return(e,c)=>{var l,r,f,n;const s=W,o=B;return i(),u("div",O,[h("div",J,[h("div",Y,[h("span",{class:"flex cursor-pointer bg-white px-1 py-px text-sm text-gray-700 hover:bg-blue-50",textContent:x(e.phrase.key)},null,8,Q)])]),h("div",X,[(l=e.phrase)!=null&&l.value_html.length&&((f=(r=e.phrase)==null?void 0:r.value_html[0])!=null&&f.value)?(i(),u("div",ee,[b(s,{phrase:e.phrase.value_html},null,8,["phrase"])])):(i(),u("div",te,x(((n=e.phrase)==null?void 0:n.value)??"Not translated yet..."),1))]),h("a",{href:e.route("ltu.source_translation.edit",e.phrase.uuid),target:"_blank",class:"transition-color relative flex w-14 cursor-pointer items-center justify-center text-gray-400 duration-100 hover:bg-blue-100 hover:text-blue-600"},[b(o,{class:"inline-block size-5"})],8,se)])}}}),ae={key:0,class:"flex flex-col divide-y"},oe={key:1,class:"relative flex size-full min-h-[250px]"},re={class:"absolute left-0 top-0 flex min-h-full w-full flex-col items-center justify-center backdrop-blur-sm"},le=h("span",{class:"mt-4 text-gray-500"},"No similar phrases found...",-1),be=S({__name:"similar-phrases",props:{similarPhrases:{}},setup(t){return(e,c)=>{const s=ne;return e.similarPhrases.length>0?(i(),u("div",ae,[(i(!0),u(C,null,N(e.similarPhrases,o=>(i(),A(s,{key:o.uuid,phrase:o},null,8,["phrase"]))),128))])):(i(),u("div",oe,[h("div",re,[b(P(V),{class:"size-12 text-gray-200"}),le])]))}}}),ce={},ie={xmlns:"http://www.w3.org/2000/svg",viewBox:"0 -960 960 960",fill:"currentColor"},ue=h("path",{d:"M560-131v-82q90-26 145-100t55-168q0-94-55-168T560-749v-82q124 28 202 125.5T840-481q0 127-78 224.5T560-131ZM120-360v-240h160l200-200v640L280-360H120Zm440 40v-322q47 22 73.5 66t26.5 96q0 51-26.5 94.5T560-320ZM400-606l-86 86H200v80h114l86 86v-252ZM300-480Z"},null,-1),pe=[ue];function he(t,e){return i(),u("svg",ie,pe)}const Se=j(ce,[["render",he]]);function fe(t){return L()?(q(t),!0):!1}function _(t){return typeof t=="function"?t():P(t)}const de=typeof window<"u"&&typeof document<"u";typeof WorkerGlobalScope<"u"&&globalThis instanceof WorkerGlobalScope;const ve=()=>{};function I(...t){if(t.length!==1)return $(...t);const e=t[0];return typeof e=="function"?K(G(()=>({get:e,set:ve}))):g(e)}const me=de?window:void 0;function _e(){const t=g(!1);return U()&&H(()=>{t.value=!0}),t}function ge(t){const e=_e();return R(()=>(e.value,!!t()))}function we(t,e={}){const{pitch:c=1,rate:s=1,volume:o=1,window:l=me}=e,r=l&&l.speechSynthesis,f=ge(()=>r),n=g(!1),d=g("init"),y=I(t||""),p=I(e.lang||"en-US"),v=D(void 0),T=(a=!n.value)=>{n.value=a},w=a=>{a.lang=_(p),a.voice=_(e.voice)||null,a.pitch=_(c),a.rate=_(s),a.volume=o,a.onstart=()=>{n.value=!0,d.value="play"},a.onpause=()=>{n.value=!1,d.value="pause"},a.onresume=()=>{n.value=!0,d.value="play"},a.onend=()=>{n.value=!1,d.value="end"},a.onerror=E=>{v.value=E}},m=R(()=>{n.value=!1,d.value="init";const a=new SpeechSynthesisUtterance(y.value);return w(a),a}),Z=()=>{r.cancel(),m&&r.speak(m.value)},M=()=>{r.cancel(),n.value=!1};return f.value&&(w(m.value),k(p,a=>{m.value&&!n.value&&(m.value.lang=a)}),e.voice&&k(e.voice,()=>{r.cancel()}),k(n,()=>{n.value?r.resume():r.pause()})),fe(()=>{n.value=!1}),{isSupported:f,isPlaying:n,status:d,utterance:m,error:v,stop:M,toggle:T,speak:Z}}function Ie(){const t={af:"af-ZA",am:"am-ET",ar:"ar-SA",az:"az-AZ",be:"be-BY",bg:"bg-BG",bn:"bn-BD",bs:"bs-BA",ca:"ca-ES",ceb:"ceb-PH",cs:"cs-CZ",cy:"cy-GB",da:"da-DK",de:"de-DE",el:"el-GR",en:"en-US",es:"es-ES",et:"et-EE",eu:"eu-ES",fa:"fa-IR",fi:"fi-FI",fil:"fil",fr:"fr-FR",ga:"ga-IE",gl:"gl-ES",gu:"gu-IN",ha:"ha-NG",he:"he-IL",hi:"hi-IN",hr:"hr-HR",ht:"ht-HT",hu:"hu-HU",hy:"hy-AM",id:"id-ID",ig:"ig-NG",is:"is-IS",it:"it-IT",ja:"ja-JP",jv:"jv-ID",ka:"ka-GE",kk:"kk-KZ",km:"km-KH",kn:"kn-IN",ko:"ko-KR",ku:"ku-TR",ky:"ky-KG",lo:"lo-LA",lt:"lt-LT",lv:"lv-LV",mk:"mk-MK",ml:"ml-IN",mn:"mn-MN",mr:"mr-IN",ms:"ms-MY",mt:"mt-MT",ne:"ne-NP",nl:"nl-NL",no:"nb-NO",pa:"pa-IN",pl:"pl-PL",ps:"ps-AF",pt:"pt-BR","pt-br":"pt-BR",ro:"ro-RO",ru:"ru-RU",sd:"sd-PK",si:"si-LK",sk:"sk-SK",sl:"sl-SI",so:"so-SO",sq:"sq-AL",sr:"sr-RS",st:"st-ZA",su:"su-ID",sv:"sv-SE",sw:"sw-TZ",ta:"ta-IN",te:"te-IN",tg:"tg-TJ",th:"th-TH",tr:"tr-TR",uk:"uk-UA",ur:"ur-PK",uz:"uz-UZ",vi:"vi-VN",xh:"xh-ZA",yo:"yo-NG",zh:"zh-CN","zh-tw":"zh-TW",zu:"zu-ZA"};function e(c){return t[c]||null}return{convertLanguageCode:e}}export{Se as _,Ie as a,W as b,be as c,V as r,we as u};
