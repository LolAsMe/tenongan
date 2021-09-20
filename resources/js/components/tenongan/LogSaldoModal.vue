<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Log Saldo</h5>
    <div slot="body">
    <div v-if="!loading">
      {{ saldo.kode }}
      Kode Saldo = {{ saldo.kode }} Jumlah Saldo = {{ saldo.saldo }} Nama
      Pedagang = {{ saldo.pedagang["nama"] }}
    </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Jumlah</th>
            <th scope="col">TimeStamp</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="log in saldo.log_saldo" :key="log.id">
            <td>{{ log.id }}</td>
            <td>{{ log.jumlah }}</td>
            <td>{{ log.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <template v-slot:footer>
      <button @click="$emit('toggle')" class="btn btn-secondary btn-sm">
        Close
      </button>
    </template>
  </basic-modal>
</template>

<script>
import Modal from "~/components/Modal";
import BasicModal from "~/components/tenongan/BasicModal";
import Form from "vform";

export default {
  name: "LogSaldoModal",
  props: {
    saldo: {
      type: undefined,
      default: { kode: "test", saldo: 0, pedagang: { nama: "test" } },
    },
    showModal: { type: Boolean, default: true },
  },
  components: {
    Modal,
    BasicModal,
  },
  data() {
    return {
      loading:true
    };
  },
  methods: {},
};
</script>
