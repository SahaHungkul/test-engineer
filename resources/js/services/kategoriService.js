import axios from "./axios";

const kategoriService = {
    getAllKategori() {
        console.log("fetching all kategori");
        return axios.get("api/kategori");
    },

    getById(id) {
        console.log(`fetching room with ID: ${id}`);
        return axios.get(`api/kategori/${id}`);
    },

    createKategori(data) {
        console.log("membuat Kategori baru :", data);
        return axios.post("api/kategori", {
            nama: data.nama,
        });
    },

    updateKategori(id, data) {
        console.log(`memperbarui kategori dari id ${id} :`, data);
        return axios.put(`api/kategori/${id}`,{
            nama: data.nama,
        });
    },
    deleteKategori(id){
        console.log(`mengapus kategori berdasarkan id dari: ${id}`);
        return axios.delete(`api/lategori/${id}`);
    }
};
