import{v as f,c as _,H as p,w as t,o as v,b as m,f as n,u as o,n as g,a as s,t as l}from"./app-14f9a69b.js";import{_ as h}from"./ActionMessage-2e4c289a.js";import{_ as w}from"./FormSection-7cf9cf37.js";import{_ as x,a as b}from"./TextInput-935a7252.js";import{_ as c}from"./InputLabel-72697f77.js";import{_ as T}from"./PrimaryButton-c555c180.js";import"./SectionTitle-4be1d56d.js";import"./_plugin-vue_export-helper-c27b6911.js";const y={class:"col-span-6"},N={class:"flex items-center mt-2"},S=["src","alt"],k={class:"ml-4 leading-tight"},V={class:"text-gray-900 dark:text-white"},$={class:"text-gray-700 dark:text-gray-300 text-sm"},B={class:"col-span-6 sm:col-span-4"},A={__name:"UpdateTeamNameForm",props:{team:Object,permissions:Object},setup(e){const r=e,a=f({name:r.team.name}),d=()=>{a.put(route("teams.update",r.team),{errorBag:"updateTeamName",preserveScroll:!0})};return(U,i)=>(v(),_(w,{onSubmitted:d},p({title:t(()=>[n(" Team Name ")]),description:t(()=>[n(" The team's name and owner information. ")]),form:t(()=>[s("div",y,[m(c,{value:"Team Owner"}),s("div",N,[s("img",{class:"w-12 h-12 rounded-full object-cover",src:e.team.owner.profile_photo_url,alt:e.team.owner.name},null,8,S),s("div",k,[s("div",V,l(e.team.owner.name),1),s("div",$,l(e.team.owner.email),1)])])]),s("div",B,[m(c,{for:"name",value:"Team Name"}),m(x,{id:"name",modelValue:o(a).name,"onUpdate:modelValue":i[0]||(i[0]=u=>o(a).name=u),type:"text",class:"mt-1 block w-full",disabled:!e.permissions.canUpdateTeam},null,8,["modelValue","disabled"]),m(b,{message:o(a).errors.name,class:"mt-2"},null,8,["message"])])]),_:2},[e.permissions.canUpdateTeam?{name:"actions",fn:t(()=>[m(h,{on:o(a).recentlySuccessful,class:"mr-3"},{default:t(()=>[n(" Saved. ")]),_:1},8,["on"]),m(T,{class:g({"opacity-25":o(a).processing}),disabled:o(a).processing},{default:t(()=>[n(" Save ")]),_:1},8,["class","disabled"])]),key:"0"}:void 0]),1024))}};export{A as default};
