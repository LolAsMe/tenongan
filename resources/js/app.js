import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'

Vue.config.productionTip = false

// Vue.directive('role', (el, binding, vnode) => {
//   if ( binding.value != store.getters['auth/user'].tipe ) {
//     // replace HTMLElement with comment node
//     const comment = document.createComment(' ');
//     Object.defineProperty(comment, 'setAttribute', {
//       value: () => undefined,
//     });
//     vnode.elm = comment;
//     vnode.text = ' ';
//     vnode.isComment = true;
//     vnode.context = undefined;
//     vnode.tag = undefined;
//     vnode.data.directives = undefined;

//     if (vnode.componentInstance) {
//       vnode.componentInstance.$el = comment;
//     }

//     if (el.parentNode) {
//       el.parentNode.replaceChild(comment, el);
//     }
//   }
// });

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
