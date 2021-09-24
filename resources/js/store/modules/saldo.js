import axios from 'axios'
import Cookies from 'js-cookie'
import store from '~/store'

// state
export const state = {
  saldos: [
  ],
  saldo: {
    "id": 1,
    "jumlah": "-600.00",
    "owner_type": "App\\Models\\Tenongan\\Pedagang",
    "owner_id": 1,
    "deleted_at": null,
    "created_at": "2021-09-24T08:52:30.000000Z",
    "updated_at": "2021-09-24T08:54:37.000000Z",
    "tipe": "Pedagang",
    "owner": {
        "id": 1,
        "nama": "Ari"
    },
    "log": [
        {
            "id": 2,
            "saldo_id": 1,
            "jumlah": "400.00",
            "status": "Ok",
            "tanggal": "2021-09-24 08:52:53",
            "keterangan": "Penambahan penjualan harian",
            "deleted_at": null,
            "created_at": "2021-09-24T08:52:53.000000Z",
            "updated_at": "2021-09-24T08:52:53.000000Z"
        },
        {
            "id": 3,
            "saldo_id": 1,
            "jumlah": "-1000.00",
            "status": "Ok",
            "tanggal": "2021-09-24 08:54:37",
            "keterangan": "Kurang dari potongan harian",
            "deleted_at": null,
            "created_at": "2021-09-24T08:54:37.000000Z",
            "updated_at": "2021-09-24T08:54:37.000000Z"
        }
    ]
}

}

// getters
export const getters = {
  saldos: state => state.saldos,
  saldo: state => state.saldo,
}

// mutations
export const mutations = {
  setSaldos: (state, saldos) => (state.saldos = saldos),
  setSaldo: (state, saldo) => (state.saldo = saldo),
  addSaldo: (state, saldo) => state.saldos.push(saldo),
  editSaldo(state, nSaldo){
    const oldSaldo = state.saldos.find( saldo => saldo.id === nSaldo.id );
    if (oldSaldo) {
      // not creating a new object but modifying old object here
      Object.assign(oldSaldo, nSaldo)
    }
  },
  deleteSaldo: (state, id) => state.saldos = state.saldos.filter(saldo => saldo.id !== id)
}

// actions
export const actions = {
  async fetchSaldos({ commit }){
    const { data } = await axios.get('/api/saldo')
    commit('setSaldos',data)
  },
  async fetchSaldo({ commit }, id){
    let owner_id = store.getters['auth/user'].owner_id
    let role = store.getters['auth/user'].tipe
    let data = []
    if(role == 'Admin'){
      data =  (await axios.get('/api/saldo/'+id)).data
    }
    if(role == 'Produsen'){
      data =  (await axios.get('/api/produsen/saldo/'+owner_id)).data
    }
    if(role == 'Pedagang'){
      data =  (await axios.get('/api/pedagang/saldo/'+owner_id)).data
    }

    commit('setSaldo',data)
  }
}
