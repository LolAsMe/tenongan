import axios from 'axios'
import Cookies from 'js-cookie'

// state
export const state = {

  rutinitass: [
    {nama:'test'}
  ],
  produsenId: 0,
}

// getters
export const getters = {
  rutinitass: state => state.rutinitass,
  produsenId: state => state.produsenId
}

// mutations
export const mutations = {
  setRutinitass: (state, rutinitass) => (state.rutinitass = rutinitass),
  setProdusenId: (state, produsenId) => (state.produsenId = produsenId),
  addRutinitas: (state, rutinitas) => state.rutinitass.push(rutinitas),
  editRutinitas(state, nRutinitas) {
    const oldrutinitas = state.rutinitass.find(rutinitas => rutinitas.id === nRutinitas.id);
    if (oldrutinitas) {
      // not creating a new object but modifying old object here
      Object.assign(oldrutinitas, nRutinitas)
    }
  },
  deleteRutinitas: (state, id) => state.rutinitass = state.rutinitass.filter(rutinitas => rutinitas.id !== id)
}

// actions
export const actions = {
  async fetchRutinitass({ commit }) {
      const { data } = await axios.get('/api/rutinitas')
      console.log(data)
      commit('setRutinitass', data.data)
  },
}
