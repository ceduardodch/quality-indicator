const fetchData = async (url) => {
    try {
      const response = await fetch(url)
      if (response.ok) {
        const jsonData = await response.json()
        return jsonData
      }
    } catch (error) {
      console.log(error)
    }
  }

export default fetchData