import{u as V,_ as j}from"./use-confirmation-dialog-cca1cc8d.js";import{_ as z}from"./base-button.vue_vue_type_script_setup_true_lang-23fac4ff.js";import{_ as T}from"./icon-trash-a5215f03.js";import{_ as $}from"./icon-pencil-3545a315.js";import{d as N,r as A,C as E,n as O,o as c,h as m,f as t,b as s,w as a,t as f,p as h,c as P,u as n,a as g,O as L,i as S}from"./app-ab645692.js";import{_ as U}from"./input-checkbox.vue_vue_type_script_setup_true_lang-3798ccd4.js";const q={class:"w-full hover:bg-gray-100"},F={class:"flex h-14 w-full divide-x"},G={class:"flex w-12 items-center justify-center p-4"},H={class:"flex w-full items-center justify-start px-4"},J={class:"truncate rounded-md border bg-white px-1.5 py-0.5 text-sm font-medium text-gray-600 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-600"},K={class:"flex w-full items-center justify-start px-4"},M={class:"w-full truncate whitespace-nowrap text-sm font-medium text-gray-600"},Q={class:"grid w-36 grid-cols-2 divide-x"},R={class:"flex flex-col p-6"},W=t("span",{class:"text-xl font-medium text-gray-700"},"Are you sure?",-1),X=t("span",{class:"mt-2 text-sm text-gray-500"}," This action cannot be undone, This will permanently delete the selected languages and all of their translations. ",-1),Y={class:"mt-4 flex gap-4"},ne=N({__name:"source-phrase-item",props:{phrase:{},selectedIds:{}},setup(v){const i=v,{loading:x,showDialog:w,openDialog:d,performAction:y,closeDialog:b}=V(),C=async e=>{await y(()=>L.delete(route("ltu.source_translation.delete_phrase",e)))},r=A(i.selectedIds.includes(i.phrase.id));return E(()=>i.selectedIds,e=>{r.value=e.includes(i.phrase.id)}),(e,o)=>{const k=U,u=S,D=$,B=T,p=z,I=j,_=O("tooltip");return c(),m("div",q,[t("div",F,[t("div",G,[s(k,{modelValue:r.value,"onUpdate:modelValue":o[0]||(o[0]=l=>r.value=l),value:e.phrase.id},null,8,["modelValue","value"])]),s(u,{href:e.route("ltu.source_translation.edit",e.phrase.uuid),class:"grid w-full grid-cols-2 divide-x"},{default:a(()=>[t("div",H,[t("div",J,f(e.phrase.key),1)]),t("div",K,[t("div",M,f(e.phrase.value),1)])]),_:1},8,["href"]),t("div",Q,[h((c(),P(u,{href:e.route("ltu.source_translation.edit",e.phrase.uuid),class:"group flex items-center justify-center px-3 hover:bg-blue-50"},{default:a(()=>[s(D,{class:"size-5 text-gray-400 group-hover:text-blue-600"})]),_:1},8,["href"])),[[_,"Edit"]]),h((c(),m("button",{type:"button",class:"group flex items-center justify-center px-3 hover:bg-red-50",onClick:o[1]||(o[1]=(...l)=>n(d)&&n(d)(...l))},[s(B,{class:"size-5 text-gray-400 group-hover:text-red-600"})])),[[_,"Delete"]])]),s(I,{size:"sm",show:n(w)},{default:a(()=>[t("div",R,[W,X,t("div",Y,[s(p,{variant:"secondary",type:"button",size:"lg","full-width":"",onClick:n(b)},{default:a(()=>[g(" Cancel ")]),_:1},8,["onClick"]),s(p,{variant:"danger",type:"button",size:"lg","is-loading":n(x),"full-width":"",onClick:o[2]||(o[2]=l=>C(e.phrase.uuid))},{default:a(()=>[g(" Delete ")]),_:1},8,["is-loading"])])])]),_:1},8,["show"])])])}}});export{ne as _};
