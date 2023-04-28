import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { Inertia } from "@inertiajs/inertia";
import { PageProps } from "@/types";
const Edit = ({ auth, grade }: PageProps) => {
    const { data, setData, errors, put } = useForm({
        level: grade.level || "",
        major: grade.major || "",
        class: grade.class || "",
        school_year: grade.school_year || "",
    });

    function handleSubmit(e: any) {
        e.preventDefault();
        put(route("grades.update", grade.id));
    }

    const handleDelete = async () => {
        if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
            Inertia.delete(route("grades.destroy", grade.id));
        }
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Ubah Data Kelas
                </h2>
            }
        >
            <Head title="Dashboard" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <h3 className="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                Ubah Data Kelas
                            </h3>
                            <p className="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400 mb-5">
                                Ubah data kelas sesuai dengan data yang benar.
                            </p>
                            <form onSubmit={handleSubmit}>
                                <div className="relative z-0 w-full mb-6 group">
                                    <select
                                        name="level"
                                        id="level"
                                        className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        onChange={(e) =>
                                            setData("level", e.target.value)
                                        }
                                    >
                                        <option value="">Pilih Tingkat</option>
                                        <option
                                            value="X"
                                            selected={grade.level === "X"}
                                        >
                                            X
                                        </option>
                                        <option
                                            value="XI"
                                            selected={grade.level === "XI"}
                                        >
                                            XI
                                        </option>
                                        <option
                                            value="XII"
                                            selected={grade.level === "XII"}
                                        >
                                            XII
                                        </option>
                                    </select>

                                    <label
                                        htmlFor="level"
                                        className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                    >
                                        Tingkat
                                    </label>
                                    <span className="text-red-600">
                                        {errors.level}
                                    </span>
                                </div>
                                <div className="relative z-0 w-full mb-6 group">
                                    <select
                                        name="major"
                                        id="major"
                                        className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        onChange={(e) =>
                                            setData("major", e.target.value)
                                        }
                                    >
                                        <option value="">Pilih Tingkat</option>
                                        <option
                                            value="IPA"
                                            selected={grade.major === "IPA"}
                                        >
                                            {" "}
                                            IPA{" "}
                                        </option>
                                        <option
                                            value="IPS"
                                            selected={grade.major === "IPS"}
                                        >
                                            {" "}
                                            IPS{" "}
                                        </option>
                                    </select>

                                    <label
                                        htmlFor="major"
                                        className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                    >
                                        Jurusan
                                    </label>
                                    <span className="text-red-600">
                                        {errors.major}
                                    </span>
                                </div>
                                <div className="relative z-0 w-full mb-6 group">
                                    <select
                                        name="class"
                                        id="class"
                                        className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        onChange={(e) =>
                                            setData("class", e.target.value)
                                        }
                                    >
                                        <option value="">Pilih Kelas</option>
                                        <option
                                            value="A"
                                            selected={grade.class === "A"}
                                        >
                                            A
                                        </option>
                                        <option
                                            value="B"
                                            selected={grade.class === "B"}
                                        >
                                            B
                                        </option>
                                        <option
                                            value="C"
                                            selected={grade.class === "C"}
                                        >
                                            C
                                        </option>
                                    </select>
                                    <label
                                        htmlFor="class"
                                        className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                    >
                                        Kelas
                                    </label>
                                    <span className="text-red-600">
                                        {errors.class}
                                    </span>
                                </div>
                                <div className="relative z-0 w-full mb-6 group">
                                    <select
                                        name="school_year"
                                        id="school_year"
                                        className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        onChange={(e) =>
                                            setData(
                                                "school_year",
                                                e.target.value
                                            )
                                        }
                                    >
                                        <option value="">
                                            Pilih Tahun Ajaran
                                        </option>
                                        <option
                                            value="2021/2022"
                                            selected={
                                                grade.school_year ===
                                                "2021/2022"
                                            }
                                        >
                                            2021/2022
                                        </option>
                                        <option
                                            value="2022/2023"
                                            selected={
                                                grade.school_year ===
                                                "2022/2023"
                                            }
                                        >
                                            2022/2023
                                        </option>
                                        <option
                                            value="2023/2024"
                                            selected={
                                                grade.school_year ===
                                                "2023/2024"
                                            }
                                        >
                                            2023/2024
                                        </option>
                                        <option
                                            value="2024/2025"
                                            selected={
                                                grade.school_year ===
                                                "2024/2025"
                                            }
                                        >
                                            2024/2025
                                        </option>
                                    </select>
                                    <label
                                        htmlFor="school_year"
                                        className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                    >
                                        Tahun Ajaran
                                    </label>
                                    <span className="text-red-600">
                                        {errors.school_year}
                                    </span>
                                </div>
                                <button
                                    type="submit"
                                    className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    Ubah
                                </button>
                                <button
                                    type="button"
                                    onClick={handleDelete}
                                    className="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ml-2"
                                >
                                    Hapus Akun
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Edit;
