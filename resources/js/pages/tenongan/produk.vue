<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Produk</h2></div>
        <div class="p-2 bd-highlight">
          <add-produk-modal></add-produk-modal>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar produk'">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nama</th>
              <th scope="col">Nama Produsen</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Harga Beli</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="produk in produks" :key="produk.id">
              <td>{{ produk.nama }}</td>
              <td>{{ produk.produsen.nama }}</td>
              <td>{{ produk.harga_jual }}</td>
              <td>{{ produk.harga_beli }}</td>
              <td>
                <dropdown name="Action">
                  <li>
                    <lihat-produk-modal
                      class="d-inline"
                      :produk="produk"
                    ></lihat-produk-modal>
                  </li>
                  <li>
                    <edit-produk-modal
                      class="d-inline"
                      :produk="produk"
                    ></edit-produk-modal>
                  </li>
                  <li>
                    <a class="dropdown-item" @click="deleteProduk(produk.id)">
                      Hapus
                    </a>
                  </li>
                </dropdown>
              </td>
            </tr>
          </tbody>
        </table>
      </card>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddProdukModal from "~/components/tenongan/AddProdukModal";
import LihatProdukModal from "~/components/tenongan/LihatProdukModal";
import EditProdukModal from "~/components/tenongan/EditProdukModal";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddProdukModal,
    LihatProdukModal,
    EditProdukModal,
    Dropdown,
  },
  computed: mapGetters({
    produks: "produk/produks",
  }),
  data() {
    return {};
  },
  methods: {
    async deleteProduk(id) {
      const { data } = await axios.delete("api/produk/" + id);
      await this.$store.commit("produk/deleteProduk", id);
    },
  },
  created() {
    this.$store.dispatch("produk/fetchProduks");
  },
  metaInfo() {
    return { title: "Produk" };
  },
};
</script>
