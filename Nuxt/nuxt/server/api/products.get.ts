export default defineEventHandler(async (event) => {
  // беремо 100 товарів, щоб сортування працювало по всьому списку, а не по 5 штуках
  const data = await $fetch('https://dummyjson.com/products?limit=100');
  return data;
})
