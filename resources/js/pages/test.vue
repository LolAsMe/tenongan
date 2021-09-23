<template>
  <div class="row">
    <div class="col">
      <card :title="$t('home')">
        <v-table></v-table>
      </card>
    </div>
  </div>
</template>

<script>
// import axios from 'axios'

import VTable from "~/components/VTable";
export default {
  middleware: "auth",
  components: {
    VTable,
  },

  // async asyncData () {
  //   const { data: projects } = await axios.get('/api/projects')

  //   return {
  //     projects
  //   }
  // },

  metaInfo() {
    return { title: "test" };
  },
};
</script>
