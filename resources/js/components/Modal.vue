<template>
    <div v-if="show" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Написать комментарий</h5>
                    <button type="button" class="close" @click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input v-model="comment.user_name" placeholder="User Name" required />
                    <input type="email" v-model="comment.email" placeholder="Email" required />
                    <input v-model="comment.home_page" placeholder="Home Page" />
                    <textarea v-model="comment.text" placeholder="Comment" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="submitComment">Отправить</button>
                    <button type="button" class="btn btn-secondary" @click="closeModal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            show: false,
            comment: {
                user_name: '',
                email: '',
                home_page: '',
                text: '',
                parent_id: null
            }
        };
    },
    methods: {
        async submitComment() {
            try {
                const response = await axios.post('http://127.0.0.1:8000/api/comments', this.comment);
                if (response.data && response.data.message) {
                    alert(response.data.message);
                    this.closeModal();
                }
            } catch (error) {
                // Обработка ошибок
            }
        },
        openModal(parentId) {
            this.comment.parent_id = parentId;
            this.show = true;
        },
        closeModal() {
            this.show = false;
        }
    }
};
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal-dialog {
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
}
</style>
