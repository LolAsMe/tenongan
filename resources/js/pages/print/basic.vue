<template>
  <div class="row">
    <div class="col">
      <div id="printarea">test</div>
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
  data() {
    return {
      itemsTitle: ["halo", "halo", "halo", "item1"],
      items: [
        ["item1", "item1", "item1", "item1"],
        ["item1", "item1", "item1", "item1"],
        ["item1", "item1", "item1", "item1"],
        ["item1", "item1", "w", "item1"],
      ],
    };
  },
  methods: {
    async test() {
      await this.$store.dispatch("produsen/fetchProdusen");

      const array1 = this.$store.getters["produsen/produsens"];

      // pass a function to map
      const map1 = array1.map(({ nama, id }) => {
        return { id, nama };
      });

      this.items = map1;

      // expected output: Array [2, 8, 18, 32]
    },
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
  created() {
    this.test();
  },
};
</script>
<style scoped>
@media print {
}
</style>
