<template>
  <div class="row">
    <div class="col">
      <card :title="'Dashboard'">
        {{ "ini halaman Dashboard" }}
      </card>
    </div>
  </div>
</template>

<script>
// import axios from 'axios'
import { mapGetters } from "vuex";

export default {
  middleware: "auth",

  // async asyncData () {
  //   const { data: projects } = await axios.get('/api/projects')

  //   return {
  //     projects
  //   }
  // },
  computed: mapGetters({
    user: "auth/user",
  }),
  // directives: {
  //   role: {
  //     // directive definition
  //     bind: function (el, binding, vnode) {
  //       if (true) {
  //         // replace HTMLElement with comment node
  //         const comment = document.createComment(" ");
  //         Object.defineProperty(comment, "setAttribute", {
  //           value: () => undefined,
  //         });
  //         vnode.elm = comment;
  //         vnode.text = "test";
  //         vnode.isComment = true;
  //         vnode.context = undefined;
  //         vnode.tag = undefined;
  //         vnode.data.directives = undefined;

  //         if (vnode.componentInstance) {
  //           vnode.componentInstance.$el = comment;
  //         }

  //         if (el.parentNode) {
  //           el.parentNode.replaceChild(comment, el);
  //         }
  //       }
  //     },
  //   },
  // },

  metaInfo() {
    return { title: "Dashboard" };
  },
};
</script>
