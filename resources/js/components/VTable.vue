<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nama</th>
        <th scope="col">Harga Jual</th>
        <th scope="col">Harga Beli</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ "produk.nama" }}</td>
        <td>{{ "produk.harga_jual" }}</td>
        <td>{{ "produk.harga_beli" }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "VTable",
  render: function (createElement) {
    return createElement("h1", "coba render");
  },
  data(){
    return {
      item: [[1,2,3],[1,2,3]]
    }
  },

  props: {
    title: { type: String, default: null },
    // item: { type: String, default: null },
    // itemTitle: { type: String, default: null },
  },
  methods:{
    test(){

    }
  },
  created(){
    this.$vnode
  }
};
</script>
