 <template>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить комментарий</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Добавить комментарий</h3>
                    <form @submit.prevent="submitComment(parent_id)">
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Имя пользователя</label>
                            <input type="text" class="form-control" id="user_name" v-model="comment.user_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" v-model="comment.email" required>
                        </div>
                        <div class="mb-3">
                            <label for="home_page" class="form-label">Домашняя страница (необязательно)</label>
                            <input type="text" class="form-control" id="home_page" v-model="comment.home_page">
                        </div>
                        <div class="mb-3">
                            <label for="home_page" class="form-label">Картинки</label>
                            <input type="file" @change="handleFileUpload" multiple />
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">Текст комментария</label>
                            <textarea class="form-control" id="text" rows="3" v-model="comment.text" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
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
            comment: {
                user_name: '',
                email: '',
                home_page: '',
                text: '',
                images: [],
                parent_id: null
            }
        }
    },
    props: ['commentId'],

    mounted() {
        this.comment.parent_id = this.commentId;  // установка значения parent_id при монтировании компонента
    },

    methods: {
        submitForm() {
            // Используйте this.commentId в вашем методе
        },
        handleFileUpload(event) {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                this.comment.images.push(file);
            }
        },
        async submitComment() {  // Добавьте аргумент parentId со значением по умолчанию null
            try {
                const formData = new FormData();
                formData.append('user_name', this.comment.user_name);
                formData.append('email', this.comment.email);
                formData.append('home_page', this.comment.home_page);
                formData.append('text', this.comment.text);

                if (this.comment.parent_id !== null) {
                    formData.append('parent_id', this.comment.parent_id);  // Используйте this.comment.parent_id
                }

                const response = await axios.post('http://127.0.0.1:8000/api/comments', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })

                if (response.data && response.data.message) {
                    alert(response.data.message);
                    this.comment = {
                        user_name: '',
                        email: '',
                        home_page: '',
                        text: '',
                        images: []  // Обнулите это поле
                    };
                }
            } catch (error) {
                console.error("Ошибка при добавлении комментария:", error);
                alert("Ошибка при добавлении комментария. Пожалуйста, попробуйте еще раз.", error);
            }
        }

    }
}
</script>
