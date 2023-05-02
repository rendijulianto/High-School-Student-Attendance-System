import AuthenticatedLayoutTeacher from "@/Layouts/AuthenticatedLayoutTeacher";
import { PageProps } from "@/types";
import { Head, useForm } from "@inertiajs/react";
const Create = ({ auth, schedule_id }: PageProps) => {
    const { data, setData, errors, post } = useForm({
        material: "",
        date: "",
    });

    function handleSubmit(e: any) {
        e.preventDefault();
        post(
            route("presences.store", {
                schedule: schedule_id,
            })
        );
    }

    return (
        <AuthenticatedLayoutTeacher
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Tambah Kelas
                </h2>
            }
        >
            <Head title="Dashboard" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <h3 className="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                Tambah Data Kehadiran Kelas
                            </h3>
                            <p className="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400 mb-5">
                                Tambah data kehadiran kelas dengan mengisi form
                                di bawah ini.
                            </p>
                            <form onSubmit={handleSubmit}>
                                <div className="relative z-0 w-full mb-6 group">
                                    <input
                                        type="text"
                                        name="material"
                                        id="material"
                                        autoComplete="off"
                                        className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" "
                                        required
                                        value={data.material}
                                        onChange={(e) =>
                                            setData("material", e.target.value)
                                        }
                                    />
                                    <label
                                        htmlFor="material"
                                        className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                    >
                                        Materi
                                    </label>
                                    <span className="text-red-600">
                                        {errors.material}
                                    </span>
                                </div>
                                <div className="relative z-0 w-full mb-6 group">
                                    <input
                                        type="date"
                                        name="date"
                                        id="date"
                                        autoComplete="off"
                                        className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" "
                                        required
                                        value={data.date}
                                        onChange={(e) =>
                                            setData("date", e.target.value)
                                        }
                                    />
                                    <label
                                        htmlFor="date"
                                        className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                    >
                                        Tanggal
                                    </label>
                                    <span className="text-red-600">
                                        {errors.date}
                                    </span>
                                </div>
                                <button
                                    type="submit"
                                    className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    Tambah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayoutTeacher>
    );
};

export default Create;
