import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import { FaRegFileExcel, FaUserGraduate } from "react-icons/fa";
const Create = ({ auth }: PageProps) => {
    const { data, setData, errors, post } = useForm({
        file: null,
    });

    function handleSubmit(e: any) {
        e.preventDefault();
        post(route("subjects.import"));
    }

    function handleFile(e: any) {
        setData("file", e.target.files[0]);
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Import Mata Pelajaran Baru dari Excel
                </h2>
            }
        >
            <Head title="Dashboard" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <h3 className="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 flex items-center space-x-2">
                                Import Mata Pelajaran Baru <FaUserGraduate />
                            </h3>
                            <p className="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400 mb-5">
                                Isi form berikut untuk menambahkan mata pelajaran baru ke
                                dalam sistem.
                            </p>
                            <form
                                onSubmit={handleSubmit}
                                encType="multipart/form-data"
                            >
                                <div className="relative z-0 w-full mb-6 group">
                                    <input
                                        type="file"
                                        name="file"
                                        id="file"
                                        autoComplete="off"
                                        className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" "
                                        required
                                        onChange={handleFile}
                                    />
                                    <label
                                        htmlFor="file"
                                        className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                    >
                                        Pilih File
                                    </label>
                                    <span className="text-red-600">
                                        {errors.file}
                                    </span>
                                </div>

                                <button
                                    type="submit"
                                    className="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 flex items-center justify-center space-x-2"
                                >
                                    Import <FaRegFileExcel className="ml-2" />
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Create;
