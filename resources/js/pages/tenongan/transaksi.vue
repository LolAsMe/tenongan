<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Transaksi</h2></div>
        <div class="p-2 bd-highlight"></div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar transaksi'">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Tanggal</th>
              <th scope="col">Tipe</th>
              <th scope="col">Nama</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody v-if="!loading">
            <tr v-for="transaksi in transaksis" :key="transaksi.id">
              <td>{{ transaksi.tanggal }}</td>
              <td>{{ transaksi.tipe }}</td>
              <td>{{ transaksi.owner }}</td>
              <td>{{ transaksi.jumlah }}</td>
              <td>{{ transaksi.status }}</td>
              <td>
                <fa
                  @click="selectedTransaksi=transaksi,$store.dispatch('transaksi/fetchTransaksi', transaksi.id)"
                  data-bs-toggle="modal" data-bs-target="#transaksiDetailModal"
                  :icon="['fa', 'info-circle']"
                />
                <fa @click="$refs.transaksiEditModal.$data.showModal = true, selectedTransaksi=transaksi" :icon="['fa', 'edit']" />
                <fa :icon="['fa', 'trash']" />
              </td>
            </tr>
          </tbody>
        </table>
      </card>
      <transaksi-detail-modal
        :name="'transaksiDetailModal'"
        :transaksi="selectedTransaksi"
      ></transaksi-detail-modal>
      <transaksi-edit-modal
        ref="transaksiEditModal"
        :transaksi="selectedTransaksi"
      ></transaksi-edit-modal>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Dropdown from "~/components/Dropdown";
import TransaksiDetailModal from "~/components/tenongan/TransaksiDetailModal";
import TransaksiEditModal from "~/components/tenongan/TransaksiEditModal";
import axios from "axios";

export default {
  middleware: "auth",
  components: {
    Dropdown,
    TransaksiEditModal,
    TransaksiDetailModal,
  },
  computed: {
    ...mapGetters({
      transaksis: "transaksi/transaksis",
    })
  },
  data() {
    return {
      loading: true,
      selectedTransaksi:{}
    };
  },
  methods: {
    async deleteTransaksi(id) {
      const { data } = await axios.delete("api/transaksi/" + id);
      await this.$store.commit("transaksi/deleteTransaksi", id);
    },
  },
  created() {
    this.$store.dispatch("transaksi/fetchTransaksis");
    this.loading = false;
  },
  metaInfo() {
    return { title: "Transaksi" };
  },
};
</script>
