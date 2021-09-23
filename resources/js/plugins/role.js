import Vue from 'vue'
import store from '~/store'

Vue.directive('role', (el, binding, vnode) => {
  if ( store.getters['auth/check'] && binding.value != store.getters['auth/user'].tipe ) {
    // replace HTMLElement with comment node
    const comment = document.createComment(' ');
    Object.defineProperty(comment, 'setAttribute', {
      value: () => undefined,
    });
    vnode.elm = comment;
    vnode.text = ' ';
    vnode.isComment = true;
    vnode.context = undefined;
    vnode.tag = undefined;
    vnode.data.directives = undefined;

    if (vnode.componentInstance) {
      vnode.componentInstance.$el = comment;
    }

    if (el.parentNode) {
      el.parentNode.replaceChild(comment, el);
    }
  }
});
