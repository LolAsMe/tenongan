<template>
<span>
  <slot v-bind:gantis="ganti">
    {{ user }}
  </slot>
</span>
</template>

<script>
import Form from "vform";

export default {
  name: "coba",
  components: {
  },
  data() {
    return {
      user: 'test',
    };
  },
  methods:{
    ganti(){
    }
  }
};
</script>
