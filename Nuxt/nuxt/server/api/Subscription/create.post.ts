export default defineEventHandler(async (event) => {
  // читаємо дані з POST запиту
  const body = await readBody(event)

  // виводим в консоль аби можна було глянути
  console.log('Отримані дані з форми:', body)

  // повертаємо відповідь на клієнт.
  return {
    success: true,
    message: 'Дані успішно відправлено на сервер!'
  }
})
