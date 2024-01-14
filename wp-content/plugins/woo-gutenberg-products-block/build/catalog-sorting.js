(()=>{var e,t={4084:(e,t,o)=>{"use strict";o.r(t);var r=o(9196);const n=window.wp.blocks;var c=o(1984),l=o(444);const s=(0,r.createElement)(l.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",fill:"none"},(0,r.createElement)("path",{stroke:"currentColor",strokeWidth:"1.5",fill:"none",d:"M6 3.75h12c.69 0 1.25.56 1.25 1.25v14c0 .69-.56 1.25-1.25 1.25H6c-.69 0-1.25-.56-1.25-1.25V5c0-.69.56-1.25 1.25-1.25z"}),(0,r.createElement)("path",{fill:"currentColor",fillRule:"evenodd",d:"M6.9 7.5A1.1 1.1 0 018 6.4h8a1.1 1.1 0 011.1 1.1v2a1.1 1.1 0 01-1.1 1.1H8a1.1 1.1 0 01-1.1-1.1v-2zm1.2.1v1.8h7.8V7.6H8.1z",clipRule:"evenodd"}),(0,r.createElement)("path",{fill:"currentColor",d:"M8.5 12h1v1h-1v-1zM8.5 14h1v1h-1v-1zM8.5 16h1v1h-1v-1zM11.5 12h1v1h-1v-1zM11.5 14h1v1h-1v-1zM11.5 16h1v1h-1v-1zM14.5 12h1v1h-1v-1zM14.5 14h1v1h-1v-1zM14.5 16h1v1h-1v-1z"})),a=JSON.parse('{"name":"woocommerce/catalog-sorting","version":"1.0.0","title":"Catalog Sorting","description":"Enable customers to change the sorting order of the products.","category":"woocommerce","keywords":["WooCommerce"],"supports":{"color":{"text":true,"background":false},"typography":{"fontSize":true}},"attributes":{"fontSize":{"type":"string","default":"small"}},"textdomain":"woo-gutenberg-products-block","apiVersion":2,"$schema":"https://schemas.wp.org/trunk/block.json"}'),i=window.wp.blockEditor,p=window.wp.components;var u=o(5736);const v=()=>(0,r.createElement)("select",{className:"orderby"},(0,r.createElement)("option",null,(0,u.__)("Default sorting","woo-gutenberg-products-block")));o(8609),(0,n.registerBlockType)(a,{icon:{src:(0,r.createElement)(c.Z,{icon:s,className:"wc-block-editor-components-block-icon"})},attributes:{...a.attributes},edit:()=>{const e=(0,i.useBlockProps)({className:"woocommerce wc-block-catalog-sorting"});return(0,r.createElement)(r.Fragment,null,(0,r.createElement)("div",{...e},(0,r.createElement)(p.Disabled,null,(0,r.createElement)(v,null))))},save:()=>null})},8609:()=>{},9196:e=>{"use strict";e.exports=window.React},9307:e=>{"use strict";e.exports=window.wp.element},5736:e=>{"use strict";e.exports=window.wp.i18n},444:e=>{"use strict";e.exports=window.wp.primitives}},o={};function r(e){var n=o[e];if(void 0!==n)return n.exports;var c=o[e]={exports:{}};return t[e].call(c.exports,c,c.exports,r),c.exports}r.m=t,e=[],r.O=(t,o,n,c)=>{if(!o){var l=1/0;for(p=0;p<e.length;p++){for(var[o,n,c]=e[p],s=!0,a=0;a<o.length;a++)(!1&c||l>=c)&&Object.keys(r.O).every((e=>r.O[e](o[a])))?o.splice(a--,1):(s=!1,c<l&&(l=c));if(s){e.splice(p--,1);var i=n();void 0!==i&&(t=i)}}return t}c=c||0;for(var p=e.length;p>0&&e[p-1][2]>c;p--)e[p]=e[p-1];e[p]=[o,n,c]},r.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return r.d(t,{a:t}),t},r.d=(e,t)=>{for(var o in t)r.o(t,o)&&!r.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.j=6720,(()=>{var e={6720:0};r.O.j=t=>0===e[t];var t=(t,o)=>{var n,c,[l,s,a]=o,i=0;if(l.some((t=>0!==e[t]))){for(n in s)r.o(s,n)&&(r.m[n]=s[n]);if(a)var p=a(r)}for(t&&t(o);i<l.length;i++)c=l[i],r.o(e,c)&&e[c]&&e[c][0](),e[c]=0;return r.O(p)},o=self.webpackChunkwebpackWcBlocksJsonp=self.webpackChunkwebpackWcBlocksJsonp||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var n=r.O(void 0,[2869],(()=>r(4084)));n=r.O(n),((this.wc=this.wc||{}).blocks=this.wc.blocks||{})["catalog-sorting"]=n})();