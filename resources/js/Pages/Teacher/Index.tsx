import Pagination from "@/Components/Pagination";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { PageProps } from "@/types";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, useForm } from "@inertiajs/react";
import {
    FaPlusCircle,
    FaRegFileExcel,
    FaDownload,
    FaSearch,
} from "react-icons/fa";
export default function Teacher(
    { auth, teachers, totalData, flash }: PageProps,
    props: any
) {
    const { data, setData, errors, get } = useForm({
        search: "",
        modalImport: false,
    });

    function handleSearch(e: React.ChangeEvent<HTMLInputElement>) {
        Inertia.get(
            route("teacher.index", {
                search: e.target.value,
            }),
            {
                preserveState: true,
                preserveScroll: true,
            }
        );
    }

    return (
        <>
            <AuthenticatedLayout
                user={auth.user}
                header={
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Daftar Guru
                    </h2>
                }
            >
                <Head title="Daftar Guru" />
                <div className="py-12">
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {flash.message && (
                            <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                <span className="block sm:inline">
                                    {flash.message}
                                </span>
                            </div>
                        )}
                        {flash.error && (
                            <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                                <span className="block sm:inline">
                                    {flash.error}
                                </span>
                            </div>
                        )}

                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                                <div className="flex items-center justify-between pb-4 bg-white dark:bg-gray-900 px-4 py-8">
                                    {/* Jika ada props message */}
                                    <div className="flex items-center space-x-4">
                                        <Link
                                            href={route("teachers.create")}
                                            className=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center space-x-2"
                                        >
                                            Tambah
                                            <FaPlusCircle className="text-white ml-1" />
                                        </Link>

                                        <Link
                                            href={route("teachers.import")}
                                            className="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center space-x-2"
                                        >
                                            Import
                                            <FaRegFileExcel className="text-white ml-1" />
                                        </Link>

                                        <Link
                                            href={route("teachers.create")}
                                            className=" bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded flex items-center space-x-2"
                                        >
                                            Contoh{" "}
                                            <FaDownload className="text-white ml-1" />
                                        </Link>
                                    </div>
                                    <form onSubmit={handleSearch}>
                                        <label className="sr-only">
                                            Search
                                        </label>
                                        <div className="relative">
                                            <div className="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg
                                                    className="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <input
                                                type="text"
                                                id="table-search-users"
                                                className="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Search for users"
                                                value={data.search}
                                                onChange={(e) =>
                                                    setData(
                                                        "search",
                                                        e.target.value
                                                    )
                                                }
                                            />
                                        </div>
                                    </form>
                                </div>
                                <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" className="p-4">
                                                <div className="flex items-center">
                                                    <input
                                                        id="checkbox-all-search"
                                                        type="checkbox"
                                                        className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                    />
                                                    <label className="sr-only">
                                                        checkbox
                                                    </label>
                                                </div>
                                            </th>
                                            <th
                                                scope="col"
                                                className="px-6 py-3"
                                            >
                                                Name
                                            </th>
                                            <th
                                                scope="col"
                                                className="px-6 py-3"
                                            >
                                                Email
                                            </th>
                                            <th
                                                scope="col"
                                                className="px-6 py-3"
                                            >
                                                Jenis Kelamin
                                            </th>
                                            <th
                                                scope="col"
                                                className="px-6 py-3"
                                            >
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {teachers.data.map((teacher: any) => (
                                            <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td className="w-4 p-4">
                                                    <div className="flex items-center">
                                                        <input
                                                            id="checkbox-table-search-1"
                                                            type="checkbox"
                                                            className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                        />
                                                        <label
                                                            htmlFor="checkbox-table-search-1"
                                                            className="sr-only"
                                                        >
                                                            checkbox
                                                        </label>
                                                    </div>
                                                </td>
                                                <th
                                                    scope="row"
                                                    className="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white"
                                                >
                                                    <div className="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                                        <span className="font-medium text-gray-600 dark:text-gray-300">
                                                            {teacher.name[0].toUpperCase()}
                                                        </span>
                                                    </div>
                                                    <div className="pl-3">
                                                        <div className="text-base font-semibold">
                                                            {teacher.name}
                                                        </div>
                                                        <div className="font-normal text-gray-500">
                                                            {teacher.nip}
                                                        </div>
                                                    </div>
                                                </th>
                                                <td className="px-6 py-4">
                                                    {teacher.email}
                                                </td>
                                                <td className="px-6 py-4">
                                                    {teacher.gender === "L"
                                                        ? "Laki-laki"
                                                        : "Perempuan"}
                                                </td>
                                                <td className="px-6 py-4">
                                                    <Link
                                                        href={route(
                                                            "teachers.edit",
                                                            {
                                                                teacher:
                                                                    teacher.id,
                                                            }
                                                        )}
                                                        className="font-medium text-blue-600 dark:text-blue-500 hover:underline hover:text-blue-800 dark:hover:text-blue-400 transition-colors duration-200 flex items-center space-x-2"
                                                    >
                                                        Ubah
                                                    </Link>
                                                </td>
                                            </tr>
                                        ))}
                                        {teachers.data.length === 0 && (
                                            <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td
                                                    className="w-4 p-4"
                                                    colSpan={5}
                                                >
                                                    <div className="flex items-center justify-center">
                                                        <div className="text-center">
                                                            <div className="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                                Data tidak
                                                                ditemukan
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                                <Pagination
                                    links={teachers.links}
                                    params={"seach=" + data.formSeach}
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </AuthenticatedLayout>
        </>
    );
}
